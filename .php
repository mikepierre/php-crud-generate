<?php
 namespace some/namespace;
 class visitation_reports extends connection
 {

 private $id;

}

 private $did;

}

 private $pid;

}

 private $heatlh_status;

}

 private $status;

}

 private $progress_notes;

}

 private $apt_date;

}

$q = $this->conn->prepare($sql);
$q->execute();
return 1;
}

$q = $this->conn->prepare($sql);
$q->execute();
$r = $q->getechAll(\PDO::FETCH_ASSOC);
return $r;
}

$q = $this->conn->prepare($sql);
$q->execute();
return 1;
}

$q = $this->conn->prepare($sql);
$q->execute();
return $r;
}

?>