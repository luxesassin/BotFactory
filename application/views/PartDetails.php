<!--
 * This is the view for Part Details page.
-->
<h1>Part Details</h1>
<div class="row">
    {part_details}
    <div>
        <img src="/pix/{model}.jpg" title="{model}, {plant}"/>
    </div>
    <div class="field-align">
        <table>
            <tr>
                <td class="field-title">MODEL:</td>
                <td class="field-content">{model}</td>
            </tr>
            <tr>
                <td class="field-title">CA:</td>
                <td class="field-content">{id}</td>
            </tr>
            <tr>
                <td class="field-title">DATE MADE:</td>
                <td class="field-content">{stamp}</td>
            </tr>
            <tr>
                <td class="field-title">LINE:</td>
                <td class="field-content">{plant}</td>
            </tr>
        </table>
    </div>
    {/part_details}
    <div class="back-align">
        <a href="/Parts" class="btn btn-5">Back</a>
    </div>
</div>
