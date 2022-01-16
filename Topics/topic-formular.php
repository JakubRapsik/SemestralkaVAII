<!DOCTYPE html>
<html lang="en">
<head>
    <title>Topic Formular</title>
</head>
<div class="main-grid-layout box1Container">
    <div style="padding-top: 10px; text-align: center" class="nameOfBox1">Topic</div>
    <?php echo $error; ?>
    <div class="box1Text">
        <div class="fillWindows">
            <form action="#" method="post">
                <?php
                if ($edit == true) {
                    $html = <<<term
                    <div class="fillWindows" style="text-align: center;">
                    <label>
                        <input value="$topic" type="text" name="Name" placeholder="Name" required
                               style="margin-top: 1%; text-align: center">
                    </label>
                    </div>
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea class="textarea" name="Description" rows="5" cols="40" maxlength="255"
                                      id="descr"
                                      placeholder="Description" required>$descr</textarea>
                        </label>
                    </div>
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea class="textarea" name="Obsah" rows="5" cols="40" maxlength="500"
                                      id="obsah"
                                      placeholder="Content" required>$cont</textarea>
                        </label>
                    </div>
                <div style="text-align: center">
                    <button type="submit" name="submit" value="Submit">Add</button>
                </div>
term;
                } else {
                    $html = <<<term
                    <div class="fillWindows" style="text-align: center;">
                    <label>
                        <input readonly value="$topic" type="text" name="Name" placeholder="Name" required
                               style="margin-top: 1%; text-align: center">
                    </label>
                    </div>
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea id="$topic" readonly class="textarea" name="Description" rows="5" cols="40" maxlength="255"
                                      placeholder="Description" required>$descr</textarea>
                        </label>
                    </div>
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea  readonly class="textarea" name="Obsah" rows="5" cols="40" maxlength="500"
                                      id="obsah$topic"
                                      placeholder="Content" required>$cont</textarea>
                        </label>
                    </div>
                    <div style="text-align: center">
                        <a href="../Topics/edit-topic.php?topic=$topic">Edit</a>
                    </div>
term;

                }
                echo $html;
                ?>
            </form>
        </div>
    </div>
</div>
</html>