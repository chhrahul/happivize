<?php
require_once __DIR__ . '/../nwc-sql-queries.php';
require_once __DIR__ . '/../nwc-util.php';
require_once(__DIR__ . '/../../woocommerce/includes/admin/reports/class-wc-admin-report.php' );
require_once(__DIR__ . '/../../woocommerce/includes/admin/reports/class-wc-report-sales-by-date.php' );

function nwc_api_orderstats()
{
    global $wp, $wpdb;

    if (!(isset($wp->query_vars['start_date']) || isset($wp->query_vars['end_date']))) {
        die(http_response_code(400));
    }

    $payment_types_data = $wpdb->get_results($wpdb->prepare(NWC_API_ORDERSTATS_SQL3, [
        $wp->query_vars['start_date'],
        $wp->query_vars['end_date']
    ]));

    $by_hour = $wpdb->get_results($wpdb->prepare(NWC_API_ORDERS_BY_HOUR, [
        $wp->query_vars['start_date'],
        $wp->query_vars['end_date']
    ]));

    $by_dow = $wpdb->get_results($wpdb->prepare(NWC_API_ORDERS_BY_DOW, [
        $wp->query_vars['start_date'],
        $wp->query_vars['end_date']
    ]));

    $by_country = $wpdb->get_results($wpdb->prepare(NWC_API_ORDERS_BY_COUNTRY, [
        $wp->query_vars['start_date'],
        $wp->query_vars['end_date']
    ]));

    $by_city = $wpdb->get_results($wpdb->prepare(NWC_API_ORDERS_BY_CITY, [
        $wp->query_vars['start_date'],
        $wp->query_vars['end_date']
    ]));

    $customers = $wpdb->get_row($wpdb->prepare(NWC_API_NEW_VS_USED_CUSTOMERS, [
        $wp->query_vars['start_date'],
        $wp->query_vars['end_date']
    ]));

    $report = new WC_Report_Sales_By_Date();

    // set custom date range.
    $report->calculate_current_range('custom');

    $report_data = $report->get_report_data();

    nwc_send_json([
        'count' => $report_data->total_orders,
        'total' => $report_data->total_sales,
        'average_total_sales' => $report_data->average_total_sales,
        'average_order_revenue' => round(nwc_divide($report_data->total_sales, $report_data->total_orders), 2),
        'tax' => $report_data->total_tax,
        'shipping' => $report_data->total_shipping,
        'total_refunded_orders' => $report_data->total_refunded_orders,
        'refunded' => $report_data->total_refunds,
        'discounts' => $report_data->total_coupons,
        'items' => $report_data->total_items,
        'items_per_order' => round(nwc_divide($report_data->total_items, $report_data->total_orders), 2),
        'chart_data' => nwc_order_chart_data($report_data),
        'payment_types' => $payment_types_data,
        'orders_by_hour' => $by_hour,
        'orders_by_dow' => $by_dow,
        'orders_by_country' => $by_country,
        'orders_by_city' => $by_city,
        'customers' => $customers->percentage,
    ]);
}

function nwc_order_chart_data($report_data)
{
    global $wp;

    $dates = nwc_get_dates($wp->query_vars['start_date'], $wp->query_vars['end_date']);

    foreach ($dates as $date) {
        $data[$date] = array(
            'count' => 0,
            'total' => 0,
            'tax' => 0,
            'shipping' => 0,
            'refunded' => 0,
            'discounts' => 0,
            'total_items' => 0,
        );
    }

    foreach ($report_data->orders as $order) {
        $date = date('Y-m-d', strtotime($order->post_date));

        $data[$date] = array_merge($data[$date], array(
            'total' => $order->total_sales,
            'tax' => $order->total_tax,
            'shipping' => $order->total_shipping,
        ));
    }

    foreach ($report_data->order_counts as $order) {
        $date = date('Y-m-d', strtotime($order->post_date));

        $data[$date] = array_merge($data[$date], array(
            'count' => $order->count,
        ));
    }

    foreach ($report_data->order_items as $order) {
        $date = date('Y-m-d', strtotime($order->post_date));

        $data[$date] = array_merge($data[$date], array(
            'total_items' => $order->order_item_count,
        ));
    }

    foreach ($report_data->full_refunds as $order) {
        $date = date('Y-m-d', strtotime($order->post_date));

        $data[$date] = array_merge($data[$date], array(
            'refunded' => $order->total_refund,
        ));
    }

    return $data;
}

function nwc_api_ordersearch()
{
    global $wp, $wpdb;
    $query = NWC_API_ORDER_SEARCH;
    $limit = 250;
    $where = array();

    if (isset($wp->query_vars['items_cond']) && isset($wp->query_vars['items'])) {
        switch ($wp->query_vars['items_cond']) {
            case 'eq':
            default:
                $where[] = $wpdb->prepare("q.order_items = %d", [$wp->query_vars['items']]);
                break;
            case 'gt':
                $where[] = $wpdb->prepare("q.order_items > %d", [$wp->query_vars['items']]);
                break;
            case 'lt':
                $where[] = $wpdb->prepare("q.order_items < %d", [$wp->query_vars['items']]);
                break;
            case 'neq':
                $where[] = $wpdb->prepare("q.order_items <> %d", [$wp->query_vars['items']]);
                break;
        }
    }

    if (isset($wp->query_vars['value_cond']) && isset($wp->query_vars['value'])) {
        switch ($wp->query_vars['value_cond']) {
            case 'eq':
            default:
                $where[] = $wpdb->prepare("q.order_value = %d", [$wp->query_vars['value']]);
                break;
            case 'gt':
                $where[] = $wpdb->prepare("q.order_value > %d", [$wp->query_vars['value']]);
                break;
            case 'lt':
                $where[] = $wpdb->prepare("q.order_value < %d", [$wp->query_vars['value']]);
                break;
            case 'neq':
                $where[] = $wpdb->prepare("q.order_value <> %d", [$wp->query_vars['items']]);
                break;
        }
    }

    if (isset($wp->query_vars['start_date']) && isset($wp->query_vars['end_date'])) {
        $where[] = $wpdb->prepare(
            "q.post_date_gmt BETWEEN %s AND %s",
            [$wp->query_vars['start_date'], $wp->query_vars['end_date']]
        );
    }

    if (isset($wp->query_vars['email'])) {
        $where[] = $wpdb->prepare("q.email LIKE %s", ['%' . $wp->query_vars['email'] . '%']);
    }

    if (isset($wp->query_vars['city'])) {
        $where[] = $wpdb->prepare("q.city LIKE %s", ['%' . $wp->query_vars['city'] . '%']);
    }

    if (isset($wp->query_vars['country'])) {
        if ($wp->query_vars['country'] !== 'ALL') {
            $where[] = $wpdb->prepare("q.country_code = %s", [$wp->query_vars['country']]);
        }
    }

    if (isset($wp->query_vars['region'])) {
        $where[] = $wpdb->prepare("q.region LIKE %s", ['%' . $wp->query_vars['region'] . '%']);
    }

    if (isset($wp->query_vars['postcode'])) {
        $where[] = $wpdb->prepare("q.postcode LIKE %s", ['%' . $wp->query_vars['postcode'] . '%']);
    }

    if (isset($wp->query_vars['page'])) {
        $page = (intval($wp->query_vars['page']) - 1);
        $offset = $page * $limit;
    } else {
        $page = 0;
        $offset = 0;
    }

    $data = $wpdb->get_results($query . ' WHERE ' . implode(' AND ', $where) . ' LIMIT ' . $offset . ',' . $limit);
    nwc_send_json($data);
}
