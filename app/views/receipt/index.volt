{{ content() }}
<h1>Receipts</h1>
{{ elements.getReceiptmenu() }}
<br>
<h3>Please select a date to see receipts and daily report</h3>
{% if (not(receipt is empty)) %}
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="text-align: center"><h4>Date</h4></th>
         </tr>
    </thead>
    <tbody>
    {% for receipt in receipt %}
    	<tr>
      </tr>
          <td><a type="button" href="/wah/receipt/date/<?php echo $receipt->date; ?>" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{ receipt.getDate() }}</a></td>
    {% endfor %}
    </tbody>
</table>
{% endif %}
