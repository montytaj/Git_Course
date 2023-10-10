 @include('layout.admin.master')
<br>
<div class="container">
    <div class="ShowCard card ServiceCard ">
    <div class="cards">
    <center><div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style="width: 50%; margin: 0 auto;"> </div></center>
    <form method="POST" name="ServiceForm"  id="ServiceForm" action="orders_report_result">  
        @csrf
        <div class="row" style="margin-right: 5px;">
	        <div class="form-group col-sm-4">
	            <label  class="col-sm-4 col-form-label"> الفترة من :    </label>
	            <input type='date' class="form-control registration-input" placeholder=""  name="FromDate" id="FromDate" value="" />
	        </div>
	        <div class="form-group col-sm-4">
	            <label  class="col-sm-4 col-form-label"> إلى   </label>
	            <input type='date' class="form-control registration-input" placeholder=""  name="ToDate" id="ToDate" value="" />
	        </div>
            <div class="form-group col-sm-4">
	            <label  class="col-sm-6 col-form-label"> الحالة   </label>
	            <select class="form-control registration-input" name="Status" id="Status">
	                <option value="-1"> كل الحالات  </option>
	                <option value="1" <?php echo "";?> >إنتظار  </option>
	                <option value="2" <?php echo "";?> > قيد الإجراء  </option>
	                <option value="4" <?php echo "";?> > تم  </option>
	            </select>
        	</div>
	    </div>

        <center>
            <button id="report" class="btn btn-primary button" onclick="return validation()" style="font-size:17px;font-weight:bold; width:100px; margin-top: 20px;margin-bottom: 20px;"> عرض </button>
        </center>

	</form>
		</div>
	</div>
</div>