<table class="table table-striped table-bordered table-hover table-condensed" id="datatablesSimple">
    <thead>
        <tr>
            <th>Type</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Remarks</th>
            <th>Created By</th>
            <th>Approver</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($record as $key => $value): ?>
             <tr>
                <td><?= strtoupper($value['type']) ?></td>
                <td><?= $value['amount'].".00" ?></td>
                <td><?= $value['status'] ?></td>
                <td><?= $value['remarks'] ?></td>
                <td><?= $this->setup->getUserName($value['created_by'])?></td>
                <td><?= $this->setup->getUserName($value['approve_by']) ?></td>
                <td><?= $value['timestamp'].".00" ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
$(document).ready(function(){
    var table = $('#datatablesSimple').DataTable();
});

