{{ content() }}
<h1>{{ date }}</h1>
{{ elements.getReceiptmenu() }}
<br>
{% if (not(receipt is empty)) %}
<table class="table table-bordered table-hover">
    <thead>
      <tr>
          <th colspan="5" style="text-align: center"><h4>Daily Report</h4></th>
      </tr>
      <tr>
            <th>Lab</th>
            <th>Medicine</th>
            <th>Admission</th>
            <th>Consultation</th>
            <th style="background-color: #ccffcc">TOTAL</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Le <?php echo number_format($lab, 0, ',', '.'); ?></td>
        <td>Le <?php echo number_format($medicine, 0, ',', '.'); ?></td>
        <td>Le <?php echo number_format($admission, 0, ',', '.'); ?></td>
        <td>Le <?php echo number_format($consultation, 0, ',', '.'); ?></td>
        <td style="background-color: #ccffcc">Le <?php echo number_format($total, 0, ',', '.'); ?></td>
      </tr>
    </tbody>
</table>
<table class="table table-bordered table-hover">
    <thead>
      <tr>
          <th colspan="5" style="text-align: center"><h4>Receipts</h4></th>
      </tr>
        <tr>
            <th>No.</th>
            <th>Category</th>
            <th>Date</th>
            <th>Total</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    {% for receipt in receipt %}
    	<tr>
          <td>{{ receipt.number }}</td>
          <td>{{ receipt.getCategory() }}</td>
	        <td>{{ receipt.getDate() }}</td>
          <td>Le <?php echo number_format($receipt->amount, 0, ',', '.'); ?></td>
          <td><a rel="tooltip" title="Delete" href="{{ url("receipt/delete/"~receipt.id) }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
      </tr>
    {% endfor %}
    </tbody>
</table>
{% endif %}
