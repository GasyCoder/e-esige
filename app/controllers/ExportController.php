<?php
class ExportController extends BaseController {
    public function data_export() {
        $table = Student::all();
        $filename = public_path().'/uploads/data/' . strtotime('now') . '.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Nom', 'Prénom', 'Matricule', 'Niveau', 'Parcour', 'Vague', 'Email', 'Telephone'), $delimiter=';');

        foreach($table as $row) {
            $fname = utf8_decode($row['fname']);
            $lname = utf8_decode($row['lname']);
            $email = utf8_decode($row->user['email']);
            $phone = utf8_decode($row->user['phone']);
            fputcsv($handle, array($fname, $lname, $row['matricule'], $row->class['short'], $row->parcour['abr'], $row->vague['abr'], $email, $phone), $delimiter=';');
        }
        fclose($handle);
        return Redirect::back()->with('download', ''. strtotime('now') . '.csv');
    }
}
