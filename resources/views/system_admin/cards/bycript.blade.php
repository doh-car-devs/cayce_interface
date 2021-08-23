<form action={{route('systemadmin.bycriptdecrypt')}} method="POST">
    <input type="text" name="crypthash">
    <input type="text" name="decrypt" value="{{}}">
    <button type="submit"> submit </button>
</form>
