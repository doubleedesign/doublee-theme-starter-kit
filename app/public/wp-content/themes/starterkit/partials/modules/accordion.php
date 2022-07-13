<?php
$heading = get_sub_field('heading');
$intro_copy = get_sub_field('intro_copy');
$panels = get_sub_field('panels');
$count = 0;

if($panels) { ?>
	<section class="module module__accordion">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-10">
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
							?>
							<div class="accordion-item">
								<h3 id="heading-<?php echo $id; ?>" class="accordion-header accordion-item__heading">
									<button class="accordion-button <?php echo ($count !== 1) ? ("") : "collapsed"; ?> accordion-item__heading__button"
											data-bs-toggle="collapse"
											role="button"
											aria-expanded="false"
											data-bs-target="#panel-<?php echo $id; ?>"
											aria-controls="panel-<?php echo $id; ?>"
									>
										<?php echo $heading; ?>
										<i class="fa-light fa-chevron-down"></i>
									</button>
								</h3>
								<div id="panel-<?php echo $id; ?>"
									 class="accordion__panel accordion-collapse collapse <?php echo ($count !== 1) ? ("show") : ""; ?>"
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

		</div>
	</section>
<?php } ?>