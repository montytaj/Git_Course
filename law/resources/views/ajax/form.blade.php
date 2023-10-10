@section('Payment')

<script src=" https://oppwa.com/v1/paymentWidgets.js?checkoutId={{$ResponseData['id']}}"></script>
		<?php
			
		if($ServiceType==1) {
			//var_dump($PaymentType);
			if($PaymentType == 1) {
		?>
				<form action="{{route('order',['ServiceID'=>$ServiceID,'OrderID'=>$OrderID,'PaymentType'=>$PaymentType])}}" class="paymentWidgets" data-brands="MADA"></form>
		<?php
			}//END if($PaymentType == 1)
			else if($PaymentType == 2) {
		?>
				<form action="{{route('order',['ServiceID'=>$ServiceID,'OrderID'=>$OrderID,'PaymentType'=>$PaymentType])}}" class="paymentWidgets" data-brands="VISA"></form>
		<?php
			}//END else if($PaymentType == 2)
			else if($PaymentType == 3) {
		?>
				<form action="{{route('order',['ServiceID'=>$ServiceID,'OrderID'=>$OrderID,'PaymentType'=>$PaymentType])}}" class="paymentWidgets" data-brands="MASTER"></form>
		<?php
			}//END else if($PaymentType == 3)
		}//END if($ServiceType==1)

		else if($ServiceType==2) {
			//var_dump($PaymentType);
			if($PaymentType == 1) {
		?>
				<form action="{{route('payoffer',['OfferID'=>$OrderID,'OrderID'=>$OrderID,'PaymentType'=>$PaymentType])}}" class="paymentWidgets" data-brands="MADA"></form>
		<?php
			}//END if($PaymentType == 1)
			else if($PaymentType == 2) {
		?>
				<form action="{{route('payoffer',['OfferID'=>$OrderID,'OrderID'=>$OrderID,'PaymentType'=>$PaymentType])}}" class="paymentWidgets" data-brands="VISA"></form>
		<?php
			}//END else if($PaymentType == 2)
			else if($PaymentType == 3) {
		?>
				<form action="{{route('payoffer',['OfferID'=>$OrderID,'OrderID'=>$OrderID,'PaymentType'=>$PaymentType])}}" class="paymentWidgets" data-brands="MASTER"></form>
		<?php
			}//END else if($PaymentType == 3)
		}//END elseif($ServiceType==2)




		?>

<script>
var wpwlOptions = {
        locale: "ar",
        style:"card" , numberFormatting:false
    }
</script>
@stop