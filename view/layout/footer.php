<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.01.2018
 * Time: 17:47
 */
?>

<!--==============================footer=================================-->

<footer>
    <div class="footer_content">

    </div>
    <div class="dontLook">
        <?php $datBoi=$this;
        if($datBoi->sessionManager->isSet('alert')){
            ?>
            <script>customMessage("<?php echo$datBoi->sessionManager->getSessionItem('alert','title')?>","<?php echo$datBoi->sessionManager->getSessionItem('alert','content')?>",<?php echo$datBoi->sessionManager->getSessionItem('alert','good')?>)</script>
        <?php } $datBoi->sessionManager->unsetSessionArray('alert');
        ?>
    </div>
</footer>

</body>
</html>

