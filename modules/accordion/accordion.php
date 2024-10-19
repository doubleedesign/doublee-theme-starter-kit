<?php
$heading = get_sub_field('heading');
$intro_copy = get_sub_field('intro_copy');
$panels = get_sub_field('panels');
$count = 0;
$theme = get_sub_field('colour_theme')[0]['colour_theme'];
$width = get_sub_field('width')[0]['width'];

if($panels) { ?>
    <section class="module module__accordion">
        <div class="row">
            <div class="<?php echo $width === 'narrow' ? 'col-12 col-lg-10' : 'col-12' ?>">
                <div class="module__accordion__intro entry-content">
                    <?php
                    if($heading) {
                        echo '<h2>' . $heading . '</h2>';
                    }
                    echo wpautop($intro_copy);
                    ?>
                </div>
                <div class="accordion">
                    <?php
                    foreach($panels as $panel) {
                        $heading = $panel['heading'];
                        $content = $panel['content'];
                        $id = sanitize_title($heading);
                        $count++;
                        $collapsed = $count === 1 ? false : true;
                        ?>
                        <div class="accordion-item">
                            <h3 id="heading-<?php echo $id; ?>" class="accordion-header accordion-item__heading">
                                <button class="accordion-button <?php echo $collapsed ? 'collapsed' : ''; ?> accordion-item__heading__button accordion-item__heading__button--<?php echo $theme; ?>"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#panel-<?php echo $id; ?>"
                                        aria-expanded="<?php echo $collapsed ? 'false' : 'true'; ?>"
                                        aria-controls="panel-<?php echo $id; ?>"
                                >
                                    <?php echo $heading; ?>
                                    <i class="fa-light fa-chevron-down"></i>
                                </button>
                            </h3>
                            <div id="panel-<?php echo $id; ?>"
                                 class="accordion-collapse collapse <?php echo $collapsed ? '' : 'show'; ?>"
                                 aria-labelledby="heading-<?php echo $id; ?>"
                            >
                                <div class="accordion-body accordion__panel__inner entry-content">
                                    <?php echo $content; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
