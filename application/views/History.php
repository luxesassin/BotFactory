<!--
 * This is the view for History page, which shows a list of 
 * the current plant's history transactions.
-->
<h1>Transaction History</h1>

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