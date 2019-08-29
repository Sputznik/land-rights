<?php
function lawsform() {
  ob_start();
  ?>
    <div class="container">
              <div class="col-md-12">
                <form role="search" method="get" id="searchform" action="<?php _e( home_url( '/' ) ); ?>">
                  <div class="input-group add-on">
                    <input class="form-control" placeholder="Search for laws and publications" value="<?php _e( get_search_query() ); ?>" name="s" id="s" type="text"/>
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>';
    <?php
    return ob_get_clean();
}
add_shortcode('laws_form', 'lawsform');
