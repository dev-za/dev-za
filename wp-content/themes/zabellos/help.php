<?php
get_header();?>
	<!--content-blog-->
	<div class="container">
		<div class="row ">
			<div class="help-content col-xs-12">
				<div class="row">
					<div class="col-sm-7 col-md-8 customer-service">
                        <?php the_field('customer_service'); ?>

                        <!--<h2>Customer Service</h2>
                        <p>Zabellos aims to provide the highest level of shoe repair craftsmanship and customer
                        service available. Our representatives are available to answer your questions,
                        discuss your repair options, and resolve any issues you have with your order.</p>
                        <p>Call us, Monday - Friday 7AM - 6PM PST:<br/>(888) 556-0172</p>
                        <p>Submit a question or comment through our contact form<br/>
                        For repair advice, email us a photo of your shoes<br/>repairs@zabellos.com</p>
                    -->
							<h2>Shipping Information</h2>

							<h3>Free Shipping</h3>
							<p>Zabellos offers free door-to-door shipping both to and from our workshop on all shoe repair orders.
							We ship to any destination in the United States. All shoe accessories purchased at the 
							same time as your repair order also ship for free. If you want to order accessories without
							a repair, please contact customer service at (888) 556-0172 for shipping details.</p>
							<p>We understand that getting your shoes back quickly is important, so we make every effort to expedite 
							the process. After placing your order online, you can expect to receive the shipping materials within 
							3-5 business days. Once you drop your shoes in the mail, it takes just 8-10 business days for us to
							receive them, repair them, and get them back to you.</p>
							<h3>Rush Orders</h3>
							<p>If you’re in a rush to get your shoes, you can pay for express service and overnight shipping. 
							For an additional $80 fee, we will repair your shoes and get them back to you within 2 business
							days from the time you dropped them in the mail.  For example, If you place your order on Wednesday, 
							and have the UPS pick up the same day, we will return your shoes on Friday.</p>
							<h3>Shipping Your Shoes</h3>
							<p class="no-margin">Zabellos makes it easy to mail us your shoes. We’ve done everything we can to make the shipping 
							process simple and hassle-free.</p>
							<ul>
								<li>Place your shoes in the Zabellos shipping box we provide</li>
								<li>Affix our postage-paid USPS mailing label to the box</li>
								<li>Drop the package in your outgoing mail</li>
							</ul>
							<p>That’s all there is to it. In 8-10 business days, your repaired shoes will come back to you.</p>
							<h2>Frequently Asked Questions</h2>
							<h3>General Questions</h3>
							<ul>
								<li>How long does it take to get my shoes repaired?</li>
								<li>How do I know which repairs are right for me?</li>
								<li>What other items do you repair besides shoes?</li>
								<li>Can I buy accessories if I’m not repairing any shoes?</li>
								<li>Can you make my shoes look like new?</li>
								<li>Do you dye shoes?</li>
								<li>What if I am dissatisfied with my repaired shoes?</li>
								<li>What happens if my product is beyond repair?</li>
								<li>Is there a warranty on repairs done by Zabellos?</li>
								<li>Does Zabellos offer corporate services?</li>
								<li>Can Zabellos make custom shoes?</li>
								<li>My shoes squeak. Can you fix it?</li>
							</ul>
							<h3>Payment Information & Refunds</h3>
							<div class="panel-group">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" href="#item-1">What forms of payment do you accept?</a>
										</h4>
									</div>
									<div id="item-1" class="panel-collapse collapse">
										<div class="panel-body">
											Yes, please contact us at (888) 556-0172 to place your gift card order.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" href="#item-2"> Does Zabellos offer gift cards?</a>
										</h4>
									</div>
									<div id="item-2" class="panel-collapse collapse in">
										<div class="panel-body">
											Yes, please contact us at (888) 556-0172 to place your gift card order.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" href="#item-3">Do you charge sales tax on any item or service?</a>
										</h4>
									</div>
									<div id="item-3" class="panel-collapse collapse">
										<div class="panel-body">
											Yes, please contact us at (888) 556-0172 to place your gift card order.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" href="#item-4">How safe is it to shop with Zabellos?</a>
										</h4>
									</div>
									<div id="item-4" class="panel-collapse collapse">
										<div class="panel-body">
											Yes, please contact us at (888) 556-0172 to place your gift card order.
										</div>
									</div>
								</div>
						
						</div>
					</div>
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
				</div>	
			</div>
		</div>
	</div>
<?php get_footer()?>