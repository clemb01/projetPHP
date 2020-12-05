@if ($note < 0)
Ce film ne possède pas encore de note
@else
Note moyenne des utilisateurs: {{ $note }} <i class="rating__icon rating__icon--star fa fa-star"></i> ({{$nbvotes}} votes)
@endif