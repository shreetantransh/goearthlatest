
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row ">
                <h1 style="text-align: center">Please do not refresh this page...</h1>
                <form method="post" action="{{ $paytm_txn_url }}" name="f1">
                    {{ csrf_field()  }}
                    <table border="1">
                        <tbody>
                        <?php
                        foreach($paramList as $name => $value) {
                            echo '<input type="text" name="' . $name .'" value="' . $value . '">';
                        }
                        ?>
                        <input type="text" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        document.f1.submit();
                    </script>
                </form>
            </div>
        </div>
    </div>
