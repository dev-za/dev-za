<?php

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->

    <div class="col-sm-5 col-md-4">
        <div class="row help-contancts ">
            <div class="col-sm-12 help-contact-form back-c">
                <h2>Contact Us</h2>
                <form role="form" class="help-form">
                    <div class="form-group">
                        <label for="Idname" class="sr-only">Name</label>
                        <input type="text" class="form-control" name="name" id="Idname" placeholder="Name" />
                    </div>
                    <div class="form-group">
                        <label for="Idemail" class="sr-only">Email</label>
                        <input type="text" class="form-control" name="email" id="Idemail" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label for="Idnum" class="sr-only">Phone Number</label>
                        <input type="text" class="form-control" name="num" id="Idnum" placeholder="Phone Number" />
                    </div>
                    <div class="form-group">
                        <label for="Idsubject" class="sr-only">Subject</label>
                        <select class="form-control" name="subject" id="Idsubject">
                            <option value="1">Subject</option>
                            <option value="2">Subject</option>
                            <option value="3">Subject</option>
                            <option value="4">Subject</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Idmessage" class="sr-only">Message</label>
                        <textarea class="form-control" id="Idmessage" name="message" rows="4" placeholder="Message"></textarea>
                    </div>
                    <input type="submit" class="btn col-xs-12 btn-primary text-uppercase" value="Send message" />
                </form>
            </div>
            <div class="col-xs-12 contact-address hidden-sm">
                <h1>Zabellos</h1>
                <p>9842 Glenoaks Blvd<br/> Sun Valley, California 91352</p>
                <p>(888) 556-0172</p>
                <p>repairs@zabellos.com</p>
            </div>
        </div>
    </div>
<?php endif; ?>