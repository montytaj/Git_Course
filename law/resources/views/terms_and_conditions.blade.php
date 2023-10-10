@extends('layout.main_master')

@section('content')
<div class="container row mx-auto align-items-center">
	<div class="header-container container">
		<div class="gradient-bg"></div>

<div class="terms_class">
		<h2>شروط الاستخدام والخصوصية لمنصة لوائح   : </h2>
		<u>
	يرجى قراءة شروط وأحكام الاستخدام أدناه بعناية تامة قبل البدء في استخدام الموقع
	باستخدام موقعنا، فإنك تؤكد على قبول شروط الاستخدام أدناه والموافقة على ما تتضمنه من أحكام.
	</u>
	<br>
	<b>شروط عامة: </b>
	<br>
	<ul style="list-style-type:square;">
		<li>
			طلب الخدمة فقط متاح لمن تتجاوز أعمارهم ١٨ سنة.  و  		الذين بإمكانهم الالتزام بالاتفاقيات والعقود المبرمة حسب الأنظمة والقوانين. 
			التعهد بأن جميع البيانات التي تقدمونها هي بيانات دقيقة وصحيحة. 
		</li>
		<li> 
			يجوز لنا تعديل شروط الاستخدام هذه في أي وقت ونشرها على هذه الصفحة، وتعتبر ملزمة لجميع المستخدمين كما أن إدارة لوائح غير مطالبة بالإعلان عن أية تحديثات تتم على هذه الشروط. .
		</li>
		<li>
			يرجى مراجعة هذه الصفحة من وقت لآخر للاطلاع على أي تعديلات في شروط الاستخدام.
			كما أن هناك بعض الخدمات التي توفرها لوائح لاحقاً وتضاف للمنصة من وقت لآخر وربما تحتاج بعض هذه الخدمات لإضافة شروط خاصة لذلك أنت ملزم بكل ما يطرأ من تعديلات على الشروط والأحكام. .		
		</li>

		<li>
			تسجيل المحامين ومكاتب المحاماة والعملاء
			لمنصة لوائح الحق في حذف حساب أي مستخدم أو تعطيل كلمة المرور في حال عدم الالتزام بأحكام وشروط الاستخدام. .
		</li>
		<li>
			في حال عدم التزام المحامي بتنفيذ الخدمات بالشكل المطلوب وفي الوقت المحدد فيحق للمنصة تعطيل حسابه أو حذفه نهائياً ومنعه من التسجيل مستقبلاً. .
		</li>
		<li>
			في حال كان هناك اختراق لحسابكم وأصبحت كلمة المرور معروفة لغيركم بإمكانكم تغييرها مباشرة أو التواصل مع إدارة لوائح لطلب المساعدة من خلال أيقونة تواصل معنا. .
		</li>
		<li>
			لا يحق للمستخدم نقل أو بيع حسابه في لوائح لأي أطراف أخرى إلا بموافقة من إدارة المنصة. .
		</li>
		<li>
			يحق لمنصة لوائح إيقاف أي حساب يقوم بخرق أي من بنود وسياسات هذه الاتفاقية أو يقوم بانتهاك  قوانين وأنظمة المملكة العربية السعودية.		
		</li>


		<h4> استرجاع الرسوم: </h4>
		<ul>

		</ul style="list-style-type:square;">
			<li>
				تشمل رسوم الخدمات ضريبة القيمة المضافة. .			
			</li>
			<li>
				كل عمليات الدفع التي تتم في المنصة تعتبر نهائية ولا يقبل فيها الاسترجاع إلا في بعض الحالات التي تخضع لتقدير المنصة وهي: 
					<ol >
						<li>
							عدم قيام المنصة بتنفيذ الخدمة. .						
						</li>
						<li>
							تغيير الخدمة من قبل العميل،  وذلك بسبب اختياره للخدمة الغير مقصودة، فيتم التسوية حسب سعر الخدمتين.				
						</li>
					</ol>			
			</li>
			<li>
				نوان الإنترنت IP
				منصة لوائح تستخدم ملفات الكوكيز لمعرفة وتتبع المستخدمين وطريقة استخدامهم للمنصة، ب   عما في ذلك نوع المتصفح ونظام التشغيل الخاص بهم ومزود خدمة الإنترنت وتفضيلاتهم للوصول للموقع. 
				</li>
			<li>
				تقوم المنصة بتتبع معلومات المستخدمين والتي تساعدنا في تحسين تجربة المستخدم والزائر. .				
			</li>
	</ul>
</div>


	</div>
</div>
	<br><br>
<center><button type="button" class="btn btn-danger button colse text-center" data-dismiss="modal" onclick="Close();">إغلاق  </button></center>	


@endsection

<script>
	function Close() {
		window.close();
	}//END function Close()
</script>


<style>
	.terms_class{
		/*background-color: gray;*/
		text-align: justify-all;
		/*text-align: right;*/
		width: 65%;
		font-size: 18px;
	}
</style>