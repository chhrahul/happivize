<div id="popupally-setting-display-customization-section-{{id}}" hide-toggle="is-open" data-dependency="display-toggle-{{id}}" data-dependency-value="true">
	<div class="popupally-setting-section">
		<input type="hidden" id="popupally-display-type-{{id}}" value="popup" />
		<table class="popupally-display-type-container">
			<tbody>
				<tr class="popupally-display-type-top-row">
					<td id="popupally-display-type-popup-{{id}}" class="popupally-display-type-tab-label-col popupally-display-type-tab-active"
						click-target="#popupally-display-type-{{id}}" click-value="popup" tab-group="popupally-display-type-{{id}}"
						target="popup" active-class="popupally-display-type-tab-active">
						Popup
					</td>
					<td id="popupally-display-type-popup-{{id}}" class="popupally-display-type-tab-label-col"
						click-target="#popupally-display-type-{{id}}" click-value="embed" tab-group="popupally-display-type-{{id}}"
						target="embed" active-class="popupally-display-type-tab-active">
						Embedded opt-in
					</td>
				</tr>
				<tr>
					<td colspan="2" class="popupally-display-type-content-cell">
						<div class="popupally-sub-setting-content-container" popupally-display-type-{{id}}="popup" style="display: block;">
							<div class="popupally-setting-section">
								<div class="popupally-setting-section-header">What kind of popup will this be?</div>
								<div class="popupally-setting-section-help-text">the first popup you assign to a page will take priority over future popups of the same trigger-type (but you can have multiple different types per page)</div>
								<div class="popupally-setting-configure-block">
									<table class="popupally-setting-configure-table">
										<tbody>
											<tr>
												<td class="popupally-setting-configure-table-left-col">
													<input class="popupally-setting-configure-checkbox" type="checkbox" input-all-false-check="popupally-conditional-display-{{id}}"
														   popupally-change-source="exit-intent-{{id}}" id="exit-intent-{{id}}" name="[{{id}}][enable-exit-intent-popup]" {{enable-exit-intent-popup}}
														   value="true"/>
												</td>
												<td class="popupally-setting-configure-table-right-col">
													<div>
														<label for="exit-intent-{{id}}" popup-id="{{id}}">Exit-intent popup</label>
													</div>
												</td>
											</tr>
											<tr hide-toggle="enable-exit-intent-popup" data-dependency="exit-intent-{{id}}" data-dependency-value="true">
												<td colspan="2">
													<div class="popupally-inline-help-text">An Exit-intent popup appears right before someone is about to leave. This is the best option to capture subscribers.</div>
												</td>
											</tr>
											<tr>
												<td class="popupally-setting-configure-table-left-col">
													<input class="popupally-setting-configure-checkbox" type="checkbox" input-all-false-check="popupally-conditional-display-{{id}}" popupally-change-source="scroll-{{id}}" id="scroll-{{id}}" name="[{{id}}][scroll]" {{scroll}} value="true"/>		
												</td>
												<td class="popupally-setting-configure-table-right-col">
													<div>
														<label for="scroll-{{id}}" popup-id="{{id}}">Scroll popup</label>
													</div>

													<table hide-toggle="scroll" data-dependency="scroll-{{id}}" data-dependency-value="true">
														<tbody>
															<tr>
																<td style="width:60%;">
																	<div>Show after scrolling <input type="text" size="4" name="[{{id}}][scroll-percent]" value="{{scroll-percent}}"/>% of page</div>
																</td>
																<td>
																	<div class="popupally-inline-help-text">Enter -1 to disable</div>
																</td>
															</tr>
															<tr>
																<td style="width:60%;">
																	<div>And when element with selector <input type="text" size="10" name="[{{id}}][scroll-trigger]" value="{{scroll-trigger}}"/> scrolls into view</div>
																</td>
																<td>
																	<div class="popupally-inline-help-text">Leave empty to disable</div>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr hide-toggle="scroll" data-dependency="scroll-{{id}}" data-dependency-value="true">
												<td colspan="2">
													<div class="popupally-inline-help-text">A scroll popup appears after the visitors have scrolled down to a certain point. It is best enabled alongside Exit-Intent.</div>
												</td>
											</tr>
											<tr>
												<td class="popupally-setting-configure-table-left-col">
													<input class="popupally-setting-configure-checkbox" type="checkbox" input-all-false-check="popupally-conditional-display-{{id}}" popupally-change-source="timed-{{id}}" id="timed-{{id}}" name="[{{id}}][timed]" {{timed}} value="true"/>
												</td>
												<td>
													<div>
														<label for="timed-{{id}}" popup-id="{{id}}">Time-delayed popup</label>
													</div>
													<table hide-toggle="timed" data-dependency="timed-{{id}}" data-dependency-value="true">
														<tbody>
															<tr>
																<td style="width:60%;">
																	<div>Show after <input type="text" size="4" name="[{{id}}][timed-popup-delay]" value="{{timed-popup-delay}}"/> seconds</div>
																</td>
																<td><div class="popupally-inline-help-text">-1 to disable; 0 to show immediately on load</div></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr hide-toggle="timed" data-dependency="timed-{{id}}" data-dependency-value="true">
												<td colspan="2">
													<div class="popupally-inline-help-text">A time-delay popup appears after a set delay. This is the most common popup, but also most annoying to visitors.</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<input type="hidden" name="[{{id}}][priority]" value="{{priority}}" />
							</div>

							<div class="popupally-setting-section">
								<div class="popupally-setting-section-header">Is this a click-to-open popup?</div>
								<div class="popupally-setting-section-help-text">A click-to-open popup is triggered through user action, usually after clicking a button or link.</div>
								<div class="popupally-setting-configure-block">
									<table class="popupally-setting-configure-table">
										<tbody>
											<tr>
												<td class="popupally-setting-configure-table-left-col">
													<input style="margin-right:10px" type="checkbox" input-all-false-check="popupally-conditional-display-{{id}}" popupally-change-source="click-{{id}}" id="click-{{id}}" name="[{{id}}][click]" {{click}} value="true"/>
												</td>
												<td>
													<div><label for="click-{{id}}" popup-id="{{id}}">Click based popup</label></div>
													<div class="popupally-setting-configure-top-margin" hide-toggle="click" data-dependency="click-{{id}}" data-dependency-value="true">
														Show the popup when visitors click on
														<div class="popupally-setting-configure-top-margin">
															<select popupally-change-source="select-click-type-{{id}}" name="[{{id}}][select-click-type]">
																<option s--select-click-type--link--d value="link">a link pointing to &quot;popup-click-open-trigger-{{id}}&quot;</option>
																<option s--select-click-type--class--d value="class">an element with HTML class &quot;popup-click-open-trigger-{{id}}&quot;</option>
																<option s--select-click-type--advanced--d value="advanced">(Advanced) custom selector</option>
															</select>
														</div>
														<div class="popupally-setting-configure-top-margin" hide-toggle="select-click-type" data-dependency="select-click-type-{{id}}" data-dependency-value="link">
															<div class="popupally-code-to-copy">popup-click-open-trigger-{{id}}</div>
														</div>
														<div class="popupally-setting-configure-top-margin" hide-toggle="select-click-type" data-dependency="select-click-type-{{id}}" data-dependency-value="class">
															<div class="popupally-code-to-copy">popup-click-open-trigger-{{id}}</div>
														</div>
														<div class="popupally-setting-configure-top-margin" hide-toggle="select-click-type" data-dependency="select-click-type-{{id}}" data-dependency-value="advanced">
															<textarea class="full-width" rows="3" name="[{{id}}][open-trigger]">{{open-trigger}}</textarea>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="popupally-setting-section">
								<div class="popupally-setting-section-header">What a visitor will see after they opt-in through this popup:</div>
								<div class="popupally-setting-section-help-text">by default, the subscriber will be redirected to the "Thank You Page" specified by your email management system. Or, you can set it to show a "Thank You Popup" without leaving the page.</div>
								<div class="popupally-setting-configure-block">
									After subscribing
									<select popupally-change-source="signup-type-popup-{{id}}" id="signup-type-popup-{{id}}" name="[{{id}}][select-signup-type-popup]">
										<option s--select-signup-type-popup--thank-you--d value="thank-you">show the Thank You page</option>
										<option s--select-signup-type-popup--popup--d value="popup">show a Thank You popup (advanced option)</option>
									</select>
								</div>
								<div class="popupally-setting-configure-block" hide-toggle="select-signup-type-popup" data-dependency="signup-type-popup-{{id}}" data-dependency-value="popup">
									<table class="popupally-setting-configure-table">
										<tbody>
											<tr>
												<td style="width:60%;">
													<label for="select-popup-after-popup-{{id}}">Show popup </label>
													<select name="[{{id}}][select-popup-after-popup]" id="select-popup-after-popup-{{id}}">
														{{select-popup-after-popup}}
													</select>
													<label for="select-popup-after-popup-{{id}}"> after subscribing.</label>
												</td>
												<td><div class="popupally-inline-help-text">WARNING: when "None" is selected, no indication will appear after subscribing, and the original popup will just close.</div></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="popupally-sub-setting-content-container"
							 popupally-display-type-{{id}}="embed" style="display: none;">
							<div class="popupally-setting-section">
								<div class="popupally-setting-section-header">Make this opt-in a part of the page?</div>
								<div class="popupally-setting-section-help-text">when embedded, the opt-in is displayed as part of the page layout instead of a popup.</div>
								<table class="popupally-setting-configure-table">
									<tbody>
										<tr>
											<td class="popupally-setting-configure-table-left-col">
												<input style="margin-right:10px" type="checkbox" input-all-false-check="popupally-conditional-display-{{id}}" popupally-change-source="embedded-{{id}}" id="embedded-{{id}}" name="[{{id}}][enable-embedded]" {{enable-embedded}} value="true"/>
											</td>
											<td>
												<div><label for="embedded-{{id}}" popup-id="{{id}}">Embedded sign up (directly display the opt-in on the page/post, NOT as a popup)</label></div>
												<div hide-toggle="enable-embedded" data-dependency="embedded-{{id}}" data-dependency-value="true">
													Show sign up box at
													<select popupally-change-source="embedded-location-{{id}}" name="[{{id}}][embedded-location]">
														<option s--embedded-location--none--d value="none">None</option>
														<option s--embedded-location--top-page--d value="top-page">top of page (not-follow)</option>
														<option s--embedded-location--top-page-follow--d value="top-page-follow">top of page (follow)</option>
														<option s--embedded-location--post-start--d value="post-start">start of post/page content</option>
														<option s--embedded-location--post-end--d value="post-end">end of post/page content</option>
														<option s--embedded-location--page-end--d value="page-end">bottom of the page (not-follow)</option>
														<option s--embedded-location--page-end-follow--d value="page-end-follow">bottom of the page (follow)</option>
														<option s--embedded-location--shortcode--d value="shortcode">Use shortcode [embed_popupally_pro]</option>
														<option s--embedded-location--widget--d value="widget">Use PopupAlly Pro Widget</option>
													</select>
													<div class="popupally-inline-help-text" hide-toggle="embedded-location" data-dependency="embedded-location-{{id}}" data-dependency-value="shortcode">
														<small>Use shortcode <b>[embed_popupally_pro popup_id="{{id}}"]</b> in the post/page content.</small>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div>
								<div class="popupally-setting-section">
									<div class="popupally-setting-section-header">What a visitor will see after they opt-in:</div>
									<div class="popupally-setting-section-help-text">by default, the subscriber will be redirected to the &quot;Thank You Page&quot; specified by your email management system. Or, you can configure more advanced options that don&#39;t redirect subscribers away from the page, like a &quot;Thank You Popup&quot; or an &quot;Embedded Thank You Box&quot; that will show up in the same space as the embedded opt-in.</div>
									<div class="popupally-setting-configure-block">
										After subscribing, 
										<select popupally-change-source="signup-type-embed-{{id}}" id="signup-type-embed-{{id}}" name="[{{id}}][select-signup-type-embed]">
											<option s--select-signup-type-embed--thank-you--d value="thank-you">show the Thank You page (default option)</option>
											<option s--select-signup-type-embed--popup--d value="popup">show a Thank You popup</option>
											<option s--select-signup-type-embed--embed-thank-you--d value="embed-thank-you">replace the opt-in with an embedded Thank You popup</option>
											<option s--select-signup-type-embed--embed-code--d value="embed-code"
													hide-toggle="embedded-location" data-dependency="embedded-location-{{id}}" data-dependency-value="shortcode">
												replace the opt-in with custom code (advanced option)
											</option>
										</select>
									</div>
									<div class="popupally-setting-configure-block" hide-toggle="select-signup-type-embed" data-dependency="signup-type-embed-{{id}}" data-dependency-value="popup">
										<table class="popupally-setting-configure-table">
											<tbody>
												<tr>
													<td style="width:60%;">
														<label for="select-popup-after-embed-{{id}}">Show popup </label>
														<select name="[{{id}}][select-popup-after-embed]" id="select-popup-after-embed-{{id}}">
															{{select-popup-after-embed}}
														</select>
														<label for="select-popup-after-embed-{{id}}"> after subscribing.</label>
													</td>
													<td><div class="popupally-inline-help-text">WARNING: when "None" is selected, no indication will appear after subscribing, and the original embedded opt-in will just disappear.</div></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="popupally-setting-configure-block" hide-toggle="select-signup-type-embed" data-dependency="signup-type-embed-{{id}}" data-dependency-value="embed-thank-you">
										<table class="popupally-setting-configure-table">
											<tbody>
												<tr>
													<td style="width:60%;">
														<label for="select-popup-embed-after-embed-{{id}}">Replace embedded opt-in with popup </label>
														<select name="[{{id}}][select-popup-embed-after-embed]" id="select-popup-embed-after-embed-{{id}}">
															{{select-popup-embed-after-embed}}
														</select>
														<label for="select-popup-embed-after-embed-{{id}}"> after subscribing.</label>
													</td>
													<td><div class="popupally-inline-help-text">WARNING: when "None" is selected, no indication will appear after subscribing, and the original embedded opt-in will just disappear.</div></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="popupally-setting-section" hide-toggle="enable-embedded" data-dependency="embedded-{{id}}" data-dependency-value="true">
									<div class="popupally-setting-section-header">What to show for existing subscribers</div>
									<div class="popupally-setting-section-help-text">by default, embedded opt-in will be shown to all visitors, regardless of whether they have subscribed.</div>
									<div class="popupally-setting-configure-block">
										For existing subscribers, 
										<select popupally-change-source="select-existing-subscribers-embed-{{id}}" id="select-existing-subscribers-embed-{{id}}" name="[{{id}}][select-existing-subscribers-embed]">
											<option s--select-existing-subscribers-embed--always--d value="always">show the embedded opt-in (default option)</option>
											<option s--select-existing-subscribers-embed--never--d value="never">do NOT show the embedded opt-in</option>
											<option s--select-existing-subscribers-embed--embed-thank-you--d value="embed-thank-you"
													hide-toggle="select-signup-type-embed" data-dependency="signup-type-embed-{{id}}" data-dependency-value="embed-thank-you">embed the Thank You popup instead</option>
											<option s--select-existing-subscribers-embed--embed-code--d value="embed-code"
													hide-toggle="select-signup-type-embed" data-dependency="signup-type-embed-{{id}}" data-dependency-value="embed-code">embed the custom code instead</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="popupally-setting-section popupally-conditional-display-{{id}}" {{display-page-selection}}>
		<div class="popupally-setting-section-header">Advanced options</div>
		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Fade-in speed</div>
			<div class="popupally-setting-section-help-text">controls how quickly the popup appears.</div>
			<div class="popupally-setting-section-help-text">for example: 0 - show the popup immediately; 0.5 - show the popup after a 0.5 second fade-in.</div>
			<div class="popupally-setting-configure-block">
				<label><strong>Fade-in</strong> <input type="text" name="[{{id}}][fade-in]" value="{{fade-in}}" /> seconds</label>
			</div>
		</div>
	</div>

	<div class="popupally-setting-section popupally-conditional-display-{{id}}" {{display-page-selection}}>
		<div hide-toggle="display-regex-filter-checked" data-dependency="display-regex-filter-checked-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-section-header">Show this popup on which posts/pages?</div>
			<div class="popupally-setting-section-help-text">select which posts or pages you'd like this popup to appear on</div>
			<div class="popupally-setting-configure-block">
				<table class="popupally-setting-configure-table">
					<tbody>
						<tr>
							<td class="popupally-setting-configure-table-left-col">
								<input type="checkbox" popupally-change-source="show-all-{{id}}" id="show-all-{{id}}" name="[{{id}}][show-all]" {{show-all}} value="true"/>
							</td>
							<td>
								<div>
									<label for="show-all-{{id}}">Show for all posts and pages sitewide?</label>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="popupally-setting-section-sub-header" hide-toggle="show-all" data-dependency="show-all-{{id}}" data-dependency-value="false">Use for only these posts/pages</div>
			<div class="popupally-setting-section-sub-header" hide-toggle="show-all" data-dependency="show-all-{{id}}" data-dependency-value="true">Do NOT use for these posts/pages</div>
			<div class="popupally-setting-section-help-text popupally-pro-warning" hide-toggle="show-all" data-dependency="show-all-{{id}}" data-dependency-value="true">the popup will NOT be shown for the pages/posts selected, ie. if "All Pages" and "All Posts" are checked, this popup will appear for NONE of the pages/posts.</div>
			<table id="page-settings-{{id}}" class="popupally-setting-page-list-table">
				<tbody>
					<tr valign="top" hide-toggle="show-all" data-dependency="show-all-{{id}}" data-dependency-value="false">
						{{include-selection}}
					</tr>
					<tr valign="top" hide-toggle="show-all" data-dependency="show-all-{{id}}" data-dependency-value="true">
						{{exclude-selection}}
					</tr>
				</tbody>
			</table>
		</div>
		<div class="popupally-setting-configure-block">
			<input name="[{{id}}][display-regex-filter-checked]" {{display-regex-filter-checked}} type="checkbox" popupally-change-source="display-regex-filter-checked-{{id}}" id="display-regex-filter-checked-{{id}}" value="true" />
			<label for="display-regex-filter-checked-{{id}}">(Advanced) Select pages to show this popup with Regular Expression. This feature is reserved for developers and support is not provided for the construction of regular expressions.</label>
		</div>
		<div hide-toggle="display-regex-filter-checked" data-dependency="display-regex-filter-checked-{{id}}" data-dependency-value="true">
			<div class="popupally-setting-section-header">Show this popup if the request URI matches one of the following regular expression(s)</div>

			<div class="popupally-setting-configure-block">
			<input name="[{{id}}][display-regex-filter-count]" type="hidden" id="display-regex-filter-count-{{id}}" value="{{display-regex-filter-count}}" />
			<table class="popupally-setting-configure-table full-width">
				<tbody id="regex-filter-{{id}}">
					{{regex-filters}}
				</tbody>
			</table>
			<div class="popupally-setting-regular-button popupally-customization-regex-add-button" popup-id="{{id}}">Add Regex Filter</div>
			</div>
		</div>
	</div>
	<div class="popupally-setting-section popupally-conditional-display-{{id}}" {{display-page-selection}}>
		<div class="popupally-setting-section-header">How to stop showing this popup</div>
		<div class="popupally-setting-section-help-text">so you don't annoy your site visitors, use these settings to set how often to show your popup</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Disable on Mobile Devices</div>
			<div>
				<table class="popupally-setting-configure-table">
					<tbody>
						<tr>
							<td style="width:20%;">
								<div>
									<input id="disable-mobile-{{id}}" name="[{{id}}][disable-mobile]" type="checkbox" {{disable-mobile}} value="true">
									<label for="disable-mobile-{{id}}">Disable</label>
								</div>
							</td>
							<td>
								<div class="popupally-inline-help-text">
									Checking this option means that no visitors on mobile devices will see your popup form. ie. people on smartphones, tablets, etc.
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Disable on Desktop Computers</div>
			<div>
				<table class="popupally-setting-configure-table">
					<tbody>
						<tr>
							<td style="width:20%;">
								<div>
									<input id="disable-desktop-{{id}}" name="[{{id}}][disable-desktop]" type="checkbox" {{disable-desktop}} value="true">
									<label for="disable-desktop-{{id}}">Disable</label>
								</div>
							</td>
							<td>
								<div class="popupally-inline-help-text">
									Checking this option means that no visitors on desktop computers (non-mobile devices) will see your popup form. ie. people on PC, MacBook, etc.
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Show popup every</div>
			<table class="popupally-setting-configure-table">
				<tbody>
					<tr>
						<td style="width:20%;">
							<div><input name="[{{id}}][cookie-duration]" type="text" size="4" value="{{cookie-duration}}"> days</div>
						</td>
						<td>
							<div class="popupally-inline-help-text">
								<ul>
									<li>-1: re-appear on every refresh/new page load. <strong>For testing ONLY!</strong></li>
									<li>0: re-appear after closing and re-opening the browser</li>
									<li>1+: re-appear after the defined number of days.</li>
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Smart Subscriber Recognition</div>
			<div class="popupally-setting-section-help-text">permanently disable this popup if the link has the specified Google Analytics utm_source</div>
			<div class="popupally-setting-section-help-text">alternatively, you can use the 'popupally_stop' tag if utm_source is removed by your email marketing platform</div>
			<table class="popupally-setting-configure-table">
				<tbody>
					<tr>
						<td style="width:60%;">
							<div><input class="full-width" name="[{{id}}][utm-source]" type="text" size="20" value="{{utm-source}}"></div>
						</td>
						<td>
							<div class="popupally-inline-help-text">
								Use comma to separate multiple utm_source tags
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="popupally-setting-section-help-text">sample link to include in your newsletter: <a class="no-click-through" href="#">{{host-url}}/post-1/?utm_source=subscriber</a> or <a class="no-click-through" href="#">{{host-url}}/post-1/?popupally_stop=subscriber</a></div>
		</div>
		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Show Thank You Page Setup</div>
			<div class="popupally-setting-section-help-text">A Thank You Page can be used to <strong>permanently</strong> stop showing this popup for visitors who have already opted in</div>
			<table class="popupally-setting-configure-table">
				<tbody>
					<tr>
						<td class="popupally-setting-configure-table-left-col">
							<input {{show-thank-you}} type="checkbox" value="true" popupally-change-source="show-thank-you-setup-{{id}}" id="show-thank-you-setup-{{id}}" />
						</td>
						<td>
							<div>
								<label for="show-thank-you-setup-{{id}}">Advanced functionality. Make sure to watch the <a class="underline" target="_blank" href="http://access.nathalielussier.com/popupally-pro/video-tutorials/making-your-popup-polite/#v2">Thank You Page Setup Tutorial</a> before enabling</label>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="popupally-setting-configure-block" valign="top" {{show-thank-you-hide}} hide-toggle data-dependency="show-thank-you-setup-{{id}}" data-dependency-value="true">
				<div class="popupally-setting-section-sub-header">Thank you page after signing-up</div>
				<div>
					<input readonly type="text" class="selected-num-status" update-num-trigger=".thank-you-page-{{id}}"><label> pages selected</label>
					<div class="include-selection page-selection-scroll">
						<ul>
							{{thank-you-page-selection}}
						</ul>
					</div>
				</div>
			</div>
			<div class="popupally-setting-configure-block" valign="top" {{show-thank-you-hide}} hide-toggle data-dependency="show-thank-you-setup-{{id}}" data-dependency-value="true">
				<div class="popupally-setting-section-sub-header">Or you can put the following script on the thank you page (need to be hosted on {{host-url}})</div>
				<div>
					<textarea class="full-width" rows="4" readonly>{{cookie-js}}</textarea>
				</div>
			</div>
		</div>
	</div>
</div>