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
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>