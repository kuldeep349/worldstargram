<?php $this->load->view('header'); ?>
<div class="cp_inner-banner">
    <div class="container">
        <div class="cp-inner-banner-holder">
            <h2>Category: <strong>Login</strong></h2>

            <ul class="breadcrumb">
                <li><span>Sort:</span><a href="index.html">Home</a></li>
                <li class="active">Login</li>
            </ul>
        </div>
    </div>
</div>

<div id="cp-main-content">

    <section class="cp-login-section pd-tb60">
        <div class="container">

            <div class="cp-form-box cp-form-box2">
                <h3>Already Member?</h3>
                <p>Ultrices proin mi urna nibh ut, aenean sollicitudin etiam libero nisl, ultrices ridiculus in magna purus conseq uuntur, ipsum donec orci ad vitae pede, id odio.
                    Turpis venenatis at laoreet.Etiam commodo fusce in diam feugiat, nullam suscipit tortor per velit viverra minim sed metus egestas sapien consectetuer elit viverra minim sed metus egestas sapien.Ultrices proin mi urna nibh ut, aenean sollicitudin etiam libero nisl, ultrices ridiculus in magna purus conseq uuntur, ipsum donec orci ad vitae pede, id odio. Turpis venenatis at laoreet.Etiam commodo. suscipit tortor per velit viverra minim sed </p>
                <form action="" method="post" id="loginForm">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="inner-holder">
                                <h3>username or email address*</h3>
                                <input type="text" placeholder="Email" name="Email">
                            </div>
                            <h3>Password*</h3>
                            <div class="inner-holder">
                                <input type="password" placeholder="Password" name="Password">
                            </div>
                            <div class="inner-holder">
                                <button type="submit" class="btn-submit" value="Submit">Login</button>
                                <a href="login.html#" class="lost-pw">Lost Password?</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Login With</h3>
                            <a href="https://www.facebook.com/"><img class="img-responsive margin-bottom5" src="images/fb.png"></a> 
                            <a href="https://plus.google.com/"><img class="img-responsive margin-bottom5" src="images/google.png"></a>
                            <a href="https://twitter.com/login?lang=en"><img class="img-responsive margin-bottom5" src="images/tweet.png"></a>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('footer'); ?>
<script>
    $(document).on('submit','#loginForm',function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var formData = $(this).serialize();
    $.post(url,formData,function(response){
        if(response.success ===1){
            window.location.href = response.url;
        }else{
            alert(response.error);
        }

    },'json');
});
</script>