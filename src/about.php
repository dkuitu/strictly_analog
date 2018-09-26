<?php
//session_start();
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';
require 'view/header.php';
?>

<article data-name="article-full-bleed-background">
    <div class="cf"
         style="background: url(http://cdn-1.dogsbestlife.com/wp-content/uploads/2014/10/soothe-dog-with-music.jpg) no-repeat center right fixed; background-size: contain;">
        <div class="fl pa3 pa4-ns bg-white black-70 measure-narrow f3 times">
            <header class="bb b--black-70 pv4">
                <h3 class="f2 fw7 ttu tracked lh-title mt0 mb3 avenir light-red">At Strictly Analog,</h3>
                <h4 class="f3 fw4 i lh-title mt0">We are obsessed with superior audio experience, and crazy about
                    building the best music collection.</h4>
            </header>
            <section class="pt5 pb4">
                <p class="times lh-copy measure f4 mt0">So, we understand your passion. That's why we are always
                    sourcing out rare and interesting albums in a variety of media. We carry vinyl, 8-track and
                    casette to satisfy your analog-fixation. We also offer fair prices, excellent condition items,
                    and fast shipping.</p>
                <p class="times lh-copy measure f4 mt0">Contact us at</p>
                <address>
                    service@strictlyanalog.site
                </address>
                <p></p>
                <p class="times lh-copy measure f4 mt0">Visit us at 123 Store Street, Victoria BC<br>
                    <iframe allowfullscreen frameborder="0" height="300"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2647.3293865643263!2d-123.37187688434071!3d48.43101767924795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x548f748316df9ddf%3A0x35a408d6d7f23ae1!2sStore+St%2C+Victoria%2C+BC!5e0!3m2!1sen!2sca!4v1494465669437"
                            style="border:0" width="300"></iframe>
                </p>
            </section>
        </div>
    </div>
</article>
<?php
require 'view/footer.php'
?>
