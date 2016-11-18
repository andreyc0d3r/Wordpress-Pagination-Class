# Wordpress-Pagination-Class
This class helps to generate pagination by relaying on WordPress core functions. The difference is with this class its easier to modify the styling of the previous/next buttons and page numbers

Pagination class in action can be found on [Digital Apps Blog](https://digitalapps.co/blog/)

#Usage
Include the class
```
<?php 
	include('inc/vendors/class-wordpress-pagination.php');
?>
```

Create object of a class.
Options for $args exaplained in the codex for [paginate_links function](https://codex.wordpress.org/Function_Reference/paginate_links)

```
<?php 
   global $wp_query;
   $args = array(
        'base'               => str_replace( 2, '%#%', esc_url( get_pagenum_link( 2 ) ) ), //user integer > 1, otherwise pagination returns initial page, which is /blog/
        'format'             => '/page/%#%/',
        'total'              => $wp_query->max_num_pages,
        'current'            => max( 1, get_query_var('paged') ),
        'show_all'           => false,
        'end_size'           => 1,
        'mid_size'           => 2,
        'prev_next'          => true,
        'prev_text'          => __('Previous Page'),
        'next_text'          => __('Next Page'),
        'type'               => 'array',
        'add_args'           => false,
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => ''
    );
   $_WPP = new WPP_Class($args);
?>
```
