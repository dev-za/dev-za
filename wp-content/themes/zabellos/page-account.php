<?php
get_header();
?>
    <div class="order-history">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">
                    <div class="row">
                        <h1 class="pull-left">Your Order History</h1>

                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>

                        <div class="order-search pull-right">
                            <form>
                                <input type="text" name="search" placeholder="Search by Order #">
                                <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/search.png" name="search-go" alt="img">
                            </form>
                        </div>
                    </div>
                </div>
                <?php //AKA: это еще не реализовано? ?>
                <div class="col-xs-12">
                    <div class="row order-history-table">
                        <table class="table">
                            <thead>
                            <tr class="back-c">
                                <th>Order Date</th>
                                <th>Order #</th>
                                <th>Total</th>
                                <th>Ship Label</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>12.01.2015</td>
                                <td>4409822</td>
                                <td>1</td>
                                <td>Some text</td>
                                <td><span class="status-process"></span>in process</td>
                            </tr>
                            <tr>
                                <td>09.01.2015</td>
                                <td>4412420</td>
                                <td>1</td>
                                <td>Some text</td>
                                <td><span class="status-complete"></span>complete</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--account-information-->
                <div class="col-xs-12 account-information">
                    <div class="row">
                        <p class="h1">Your Account Information</p>
                        <div class="back-fff col-xs-12 checkout-address">
                            <p class="font-20 ship-address">Your Shipping Address</p>
                            <div class="col-sm-6 address-left">
                                <p class="font-20">Maksym Romanchuk</p>
                                <p>5 Street 22<br>New York, NY 10001<br>US<br>Phone: +1 (818) 333-5377</p>
                                <button type="button" class="btn btn-primary">Edit</button>
                                <button type="button" class="btn btn-link">Delete</button>
                            </div>
                            <div class="col-sm-6 address-right hidden-xs hidden-sm">
                                <p class="font-20">Maksym Romanchuk</p>
                                <p>2 Street 14<br>New York, NY 10001<br>US<br>Phone: +1 (818) 333-5377</p>
                                <button type="button" class="btn btn-primary">Edit</button>
                                <button type="button" class="btn btn-link">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 back-fff">
                    <form>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-5 col-md-4">
                                    <div class="row">
                                        <p class="font-20">Account Information</p>
                                        <div class="form-group">
                                            <label class="sr-only" for="Idaccount-information-first-name">First Name</label>
                                            <input type="text" class="form-control" id="Idaccount-information-first-name" name="account-information-first-name" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="Idaccount-information-last-name">Last Name</label>
                                            <input type="text" class="form-control" id="Idaccount-information-last-name" name="account-information-last-name" placeholder="Last Name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="Idaccount-information-email">Email</label>
                                            <input type="text" class="form-control" id="Idaccount-information-email" name="account-information-email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-5 col-sm-offset-2 col-md-4 col-md-offest-1">
                                    <div class="row">
                                        <p class="font-20">Update Your Password</p>
                                        <div class="form-group">
                                            <label class="sr-only" for="Idaccount-information-password">Current Password</label>
                                            <input type="password" class="form-control" id="Idaccount-information-password" name="account-information-password" placeholder="Current Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="Idaccount-information-new-password">New Password</label>
                                            <input type="password" class="form-control" id="Idaccount-information-new-password" name="account-information-new-password" placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="Idaccount-information-confirm-password">Confirm Password</label>
                                            <input type="password" class="form-control" id="Idaccount-information-confirm-password" name="account-information-confirm-password" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 uppdate-password">
                            <div class="row">
                                <input type="submit" value="Submit" class="btn btn-danger pull-right">
                                <input type="reset" value="Cancel" class="btn btn-link pull-right">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>
