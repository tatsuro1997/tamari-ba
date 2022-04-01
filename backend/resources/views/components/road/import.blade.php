<form method="post" action="/roads_import" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" ><br>
    <input type="submit" value="インポート">
</form>
