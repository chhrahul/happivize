<input readonly type="text" class="selected-num-status" update-num-trigger=".{{selection-type}}-page-{{id}}"><label> items selected</label>
<div class="{{selection-type}}-selection page-selection-scroll">
	<div class="selection-tree-container">
		<input type="checkbox" value="closed" class="checkbox-parent-expand" id="expand-{{selection-type}}-{{id}}-all-pages" />
		<label for="expand-{{selection-type}}-{{id}}-all-pages"></label>
		<input type="checkbox" c--all-pages--d class="{{selection-type}}-page-checkbox {{selection-type}}-page-{{id}}" id="{{selection-type}}-all-page-{{id}}" value="true" name="[{{id}}][{{selection-type}}][all-pages]">
		<label for="{{selection-type}}-all-page-{{id}}">All pages</label>
		<ul>
			<li>
				<label>Special Pages</label>
				<ul>
					<li>
						<input class="{{selection-type}}-page-checkbox {{selection-type}}-page-{{id}}" c--front-page--d id="{{selection-type}}-{{id}}-front-page" type="checkbox" value="true" name="[{{id}}][{{selection-type}}][front-page]"><label for="{{selection-type}}-{{id}}-front-page">Front Page</label>
					</li>
					<li>
						<input class="{{selection-type}}-page-checkbox {{selection-type}}-page-{{id}}" c--blog-index--d id="{{selection-type}}-{{id}}-blog-index" type="checkbox" value="true" name="[{{id}}][{{selection-type}}][blog-index]"><label for="{{selection-type}}-{{id}}-blog-index">Post Page</label>
					</li>
					<li>
						<input class="{{selection-type}}-page-checkbox {{selection-type}}-page-{{id}}" c--404-page--d id="{{selection-type}}-{{id}}-404-page" type="checkbox" value="true" name="[{{id}}][{{selection-type}}][404-page]"><label for="{{selection-type}}-{{id}}-404-page">404 Page</label>
					</li>
					<li>
						<label>Category Pages</label>
						<ul>
							{{category-page-selection}}
						</ul>
					</li>
				</ul>
			</li>
			{{page-selection}}
		</ul>
	</div>
{{custom-page-selection}}
</div>