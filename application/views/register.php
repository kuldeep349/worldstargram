<?php $this->load->view('header'); ?>

<div class="cp_inner-banner">
    <div class="container">
        <div class="cp-inner-banner-holder">
            <h2>Category: <strong>Register</strong></h2>

            <ul class="breadcrumb">
                <li><span>Sort:</span><a href="index.html">Home</a></li>
                <li class="active">Register</li>
            </ul>
        </div>
    </div>
</div>

<div id="cp-main-content">

    <section class="cp-register-section pd-tb60">
        <div class="container">

            <div class="cp-form-box cp-form-box2">
                <h3>Register Now?</h3>
                <p>Ultrices proin mi urna nibh ut, aenean sollicitudin etiam libero nisl, ultrices ridiculus in magna purus conseq uuntur, ipsum donec orci ad vitae pede, id odio.
                    Turpis venenatis at laoreet.Etiam commodo fusce in diam feugiat, nullam suscipit tortor per velit viverra minim sed metus egestas sapien consectetuer elit viverra minim sed metus egestas sapien.Ultrices proin mi urna nibh ut, aenean sollicitudin etiam libero nisl, ultrices ridiculus in magna purus conseq uuntur, ipsum donec orci ad vitae pede, id odio. Turpis venenatis at laoreet.Etiam commodo. suscipit tortor per velit viverra minim sed </p>
                <form action="<?php echo base_url('User/register'); ?>" id="registrationform" method="post">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="inner-holder">
                                <h3>Username*</h3>
                                <input type="text" placeholder="Enter Your Name..." name="Username" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="inner-holder">
                                <h3>Email address*</h3>
                                <input type="text" placeholder="Email" name="Email" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="inner-holder">
                                <h3>Name </h3>
                                <input type="text" placeholder="Card No." name="Name" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <h3>Password*</h3>
                            <div class="inner-holder">
                                <input type="password" placeholder="Password" name="Password" required pattern="[a-zA-Z ]+">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="inner-holder">
                                <label><input type="radio"  name="role" value="C">Register As A Constants</label>
                                <label><input type="radio" name="role" value="F" required>Register As A Fan</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="inner-holder">
                                <button type="submit" class="btn-submit btn-register" value="Submit">Sign Up Now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div> 

<?php $this->load->view('footer'); ?> 
<script>
    $(document).on('submit', '#registrationform', function (e) {
        e.preventDefault();
        var url, formData;
        url = $(this).attr('action');
        formData = $(this).serialize();
        $.post(url, formData, function (response) {
            alert(response.message);
            if (response.success == 1)
                location.reload();
        }, 'json');
    });
</script>