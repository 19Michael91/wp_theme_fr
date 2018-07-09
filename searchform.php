<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <input type="search" class="search-field"
            placeholder="Search in Blog"
            value="<?php echo get_search_query() ?>" name="s"
            title="Search in Blog" />
    </label>
    <input type="submit" class="search-submit" value="" />
       
</form>
