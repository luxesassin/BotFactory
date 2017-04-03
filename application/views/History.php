<h1>Transaction History</h1>

<div class="dropdown pull-right">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Records/Page
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li><a href="/History/recordsPerPage/20">20</a></li>
        <li><a href="/History/recordsPerPage/25">25</a></li>
    </ul>
</div>

<a href="/history/orderByDateTime/1"><input type="button" value="Order by datetime"/></a>
<a href="/history/orderByrobotmodel/1"><input type="button" value="Order by robot model"/></a>

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

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>