<?php
function getGrades($grade) {
    if ($grade >= 80) {
        return 'A';
    } else if ($grade >= 70) {
        return 'A-';
    } else if ($grade >= 65) {
        return 'B+';
    } else if ($grade >= 60) {
        return 'B';
    } else if ($grade >= 55) {
        return 'B-';
    } else if ($grade >= 50) {
        return 'C+';
    } else if ($grade >= 45) {
        return 'C';
    } else if ($grade >= 40) {
        return 'D';
    } else {
        return 'E';
    }
}


function getNA($grade) {
    switch ($grade) {
        case "A":
            return 4;
            break;
        case "A-":
            return 3.7;
            break;
        case "B+":
            return 3.4;
            break;
        case "B":
            return 3;
            break;
        case "B-":
            return 2.7;
            break;
        case "C+":
            return 2.4;
            break;
        case "C":
            return 2;
            break;
        case "D":
            return 1;
            break;
        case "E":
            return 0;
            break;
    }
}

function hitungIP($nim) {
    global $con;
    $getMatkulStmt = $con->prepare("SELECT m.sks, n.grade 
                                    FROM matkul m INNER JOIN nilai n ON n.kode_mk = m.kode_mk
                                    WHERE n.nim = ?;");
    $getMatkulStmt->bind_param("s", $nim);
    $getMatkulStmt->execute();
    $getMatkulResult = $getMatkulStmt->get_result();
    $totalSKS = 0;
    $totalNilai = 0;

    while ($row = $getMatkulResult->fetch_assoc()) {
        $totalSKS += $row["sks"];
        $totalNilai += $row["sks"] * getNA(decryptData($row["grade"]));
    }

    return number_format($totalNilai / $totalSKS, 2);
}
?>