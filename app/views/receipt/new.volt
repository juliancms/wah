{{ content() }}

<h1>New Receipt</h1>
{{ elements.getReceiptmenu() }}
<br>
{{ form("receipt/save/", "method":"post", "class":"form-container form-horizontal", "data-parsley-validate" : "") }}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="number">N°</label>
        <div class="col-sm-10">
              {{ text_field("number", "class" : "form-control required", "data-parsley-type" : "number", "value" : number) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="number">Category</label>
        <div class="col-sm-10">
          <select id="category" name="category" class="form-control required" title="Choose one of the following..." >
              <option value="">Choose one of the following...</option>
              <option value="1">Lab</option>
              <option value="2">Medicine</option>
              <option value="3">Admission</option>
              <option value="4">Consultation</option>
          </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="amount">Total Le</label>
        <div class="col-sm-10">
              {{ text_field("amount", "class" : "form-control autoNumeric required") }}
        </div>
    </div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
          {{ submit_button("Save", "class" : "btn btn-default") }}
    </div>
</div>
</form>
