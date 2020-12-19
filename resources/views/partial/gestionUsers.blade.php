@if ($model == null || count($model->Users()) < 1 )
        <p>Aucun utilisateurs enregistré</p>
@else
<table class="table">
  <thead>
    <tr>
      <th scope="col">Login</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($model->Users() as $user)        
    <tr>
        <th scope="row">{{ $user->getLogin() }}</th>
        <td>{{ $user->getNom() }}</td>
        <td>{{ $user->getPrenom() }}</td>
        <td>
            <select class="form-control form-control-sm" onchange="editUser({{ $user->getId() }}, this, {{ $model->Page() }})">
                <option value="user" {{ $user->getRole() === "user" ? "selected" : "" }}>user</option>
                <option value="modo" {{ $user->getRole() === "modo" ? "selected" : "" }}>modo</option>
                <option value="admin" {{ $user->getRole() === "admin" ? "selected" : "" }}>admin</option>
            </select>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@if($model->Total_pages() > 1)
<div class="text-center justify-content-center">
    <p>
        @if ($model->Page() > 1)
        <a href="#" onclick="changePage(1);">Début</a> -
        <a href="#" onclick="changePage({{ $model->Page() > 1 ? $model->Page() - 1 : 1 }});">Précédent</a>
        @endif
        - Page {{ $model->Page() }} -
        @if ($model->Page() < $model->Total_pages())
        <a href="#" onclick="changePage({{ $model->Page() < $model->Total_pages() ? $model->Page() + 1 : $model->Total_pages() }});">Suivant</a> -
        <a href="#" onclick="changePage({{ $model->Total_pages() }});">Fin</a>
        @endif
    </p>
</div>
@endif
@endif