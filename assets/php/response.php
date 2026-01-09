<?php
include "validation.php";
if (empty($errorContainer)) {
    echo json_encode(array('result' => 'success'));
} else {
    echo json_encode(array('result' => 'error', 'text_error' => $errorContainer));
}
