<?php $this->assign('title', 'Dashboard');?>

<body>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>it all starts here</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Hello</h3>
            </div>
            <div class="box-body">
                Welcome To Dashboard
            <table>
                <tr>
                    <th>Serial_num</th>
                    <th>Date</th>
                    <th>Site Code</th>
                    <th>Voltage_in</th>
                    <th>Voltage_out</th>
                    <th>Temperature_in</th>
                    <th>Temperature_out</th>

                </tr>
                <?php foreach ($noman as $value) { ?>
                 <tr>
                     <td><?php echo $value ['GsmTable']['sl_num'];?> </td>
                     <td><?php echo $value ['GsmTable']['date'];?> </td>
                     <td><?php echo $value ['GsmTable']['site_code'];?> </td>
                     <td><?php echo $value ['GsmTable']['value1'];?> </td>
                     <td><?php echo $value ['GsmTable']['value2'];?> </td>
                     <td><?php echo $value ['GsmTable']['temp_in'];?> </td>
                     <td><?php echo $value ['GsmTable']['temp_out'];?> </td>
                 </tr> 
                <?php } ?>
            </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->


    </section><!-- /.content -->
</div><!-- /.content-wrapper -->




</body>