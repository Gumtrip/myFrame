<?php $name = $request->get('name', 'Foo') ?>

Hello <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>