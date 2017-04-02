<!--
 * This is the view for History page, which shows a list of 
 * the current plant's history transactions.
-->
<h1>Transaction History</h1>
<form method='POST' action='/History'>
    <span class="login-title">Sort by: </span>
    <select name="sort" size="1" onchange="this.form.submit()">
      <option value="0" selected="selected">{sort}</option>
      <option value="1">Transaction ID</option>
      <option value="2">Transaction Date</option>
      <option value="3">Transaction Type</option>
      <option value="4">Transaction Amount</option>
      <option value="5">Model Series</option>
    </select>
    {pagination}
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Transaction ID</th>
                    <th>Transaction Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Details</th>
                    <th>Valid</th>
                </tr>
            </thead>
            <tbody>
                {histories}
                <tr>
                    <td>{id}</td>
                    <td>{transId}</td>
                    <td>{transDate}</td>
                    <td>{type}</td>
                    <td>{amount}</td>
                    <td>{detail}</td>
                    <td>{isValid}</td>
                </tr>
                {/histories}
            </tbody>
        </table>
    </div>
</form>