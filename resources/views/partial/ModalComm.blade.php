
<input name="comm_id" value="{{$commentaire->Id()}}" hidden/>
<input name="MovieId" value="{{$commentaire->FilmId()}}" hidden/>
<fieldset>
    <div class="form-group">
        <label for="commentaire">Message</label>
        <textarea class="form-control" name="Message" id="commentaire" rows="3" required>{{ $commentaire->Contenu() }}</textarea>
    </div>
</fieldset>