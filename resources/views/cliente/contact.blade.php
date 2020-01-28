@extends('cliente.template.app')
@section('titulo', 'Quienes Somos')

@section('header')

@include('cliente.template.componentes.header_middle')
@include('cliente.template.componentes.header_bottom')
<!-- Begin Mobile Menu Area -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="mobile-menu-area d-lg-none d-xl-none col-12">
	<div class="container"> 
		<div class="row">
			<div class="mobile-menu">
			</div>
		</div>
	</div>
</div>
<!-- Mobile Menu Area End Here -->
@endsection

@section('body')

@include('cliente.template.componentes.breadcrumb_area', ['pages' => ['Inicio', 'Contacto']])

<div class="container mb-60">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13003.49912621912!2d-71.6588077!3d-35.4331318!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb865bcedc7bbf941!2sLibrer%C3%ADa%20Adimel!5e0!3m2!1ses-419!2scl!4v1576811132686!5m2!1ses-419!2scl" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>



<div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                <div class="contact-page-side-content">
                    <h3 class="contact-page-title">Contáctanos</h3>
                    <p class="contact-page-message mb-25">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human.</p>
                    <div class="single-contact-block">
                        <h4><i class="fa fa-fax"></i> Dirección</h4>
                        <p> Calle 6 Ote. 640, Talca, Maule</p>
                    </div>
                    <div class="single-contact-block">
                        <h4><i class="fa fa-phone"></i> Teléfono</h4>
                        <p>Mobile: (71) 221 5408</p>
                    </div>
                    <div class="single-contact-block last-child">
                        <h4><i class="fa fa-envelope-o"></i> Email</h4>
                        <p>webadimel@gmail.com</p>                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                <div class="contact-form-content pt-sm-55 pt-xs-55">
                    <h3 class="contact-page-title">Escríbenos tu mensaje</h3>
                    <div class="contact-form">
                        <form id="contact-form" action="http://demo.hasthemes.com/limupa-v3/limupa/mail.php" method="post">
                            <div class="form-group">
                                <label>Tu Nombre <span class="required">*</span></label>
                                <input type="text" name="customerName" id="customername" required="">
                            </div>
                            <div class="form-group">
                                <label>Tu E-mail <span class="required">*</span></label>
                                <input type="email" name="customerEmail" id="customerEmail" required="">
                            </div>
                            <div class="form-group">
                                <label>Asunto</label>
                                <input type="text" name="contactSubject" id="contactSubject">
                            </div>
                            <div class="form-group mb-30">
                                <label>Tu Mensaje</label>
                                <textarea name="contactMessage" id="contactMessage"></textarea>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LceONEUAAAAAOB8X-YJE2C33p8zODSNNR64JkP2"></div>
                            <div class="form-group">
                                <button type="submit" value="submit" id="submit" class="li-btn-3" name="submit">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <p class="form-messege"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('footer')

@include('cliente.template.componentes.footer_middle')
@include('cliente.template.componentes.footer_bottom')

@endsection


<script type="text/javascript">
  var onloadCallback = function() {
    //alert("grecaptcha is ready!");
};
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
async defer>
</script>

