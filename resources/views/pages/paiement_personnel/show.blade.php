{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Paiement-Personnel-Detail'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Historique De Paiement D'un Personnel</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Historique De Paiement D'un Personnel</li>
            </ol>
        </div>
    </div>
    @if($all_paiement->count() > 0)
        <a href="{{ route('paiement_des_personnels_par_mois',$all_paiement->last()->mois_paiement) }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
    @else
        <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fa fa-reply"></i> Retour</a>
    @endif
   <br><br>
    <div id="media_screen" class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <div class="card">
                <div class="card-head card-topline-aqua">
                    <header>Informations Du Personnel</header>
                </div>
                <div class="card-body no-padding height-9">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nom: {{ $personnel->nom}}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Prénom: {{ $personnel->prenom }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Poste: {{ $personnel->poste }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Téléphone: {{ $personnel->telephone}}</b>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <!-- END BEGIN PROFILE SIDEBAR -->

            <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div>
                        <div class="card">
                            <div class="card-head card-topline-aqua">
                                <header>Historique Des Paiements D'un Personnel</header>
                            </div>
                            <div class="white-box">
                                <a id="media_screen"  href="#" onclick="printDiv('imprime')" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Imprimer le reçu</a>
                                    <div class="table-scrollable mt-5">
                                        <table
                                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="eleves">
                                            <thead>
                                                <tr>
                                                    <th class="text-center"> Montant Payer </th>
                                                    <th class="text-center"> Type De Paiement</th>
                                                    <th class="text-center"> Date </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($personnel->paiementPersonnels as $paiement)
                                                    <tr class="odd gradeX">
                                                        <td class="text-center" style="width: 20%">
                                                            {{ number_format($paiement->somme_payer,0,',',' ').' GNF' }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $paiement->type_paiement }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $paiement->date_paiement->format('d/m/Y') }}
                                                        </td>
                                                        <td>

                                                            <a class="btn btn-primary" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $paiement->id }}">
                                                                <i class="fa fa-pencil"></i> Modifier
                                                            </a>
                                                            <a href="#myModaldelete" data-toggle="modal" onclick="deleteData({{ $paiement->id }})"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash"></i> Supprimer
                                                            </a>
                                                            <div id="myModaldelete" class="mt-5 modal fade" data-backdrop="static">
                                                                <div class="mt-5 modal-dialog modal-confirm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header flex-column">
                                                                            <div class="icon-box">
                                                                                <i class="material-icons">&#xE5CD;</i>
                                                                            </div>
                                                                            <h4 class="modal-title w-100">Êtes-vous certain?</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>
                                                                                Vous pouvez restaurer vos données supprimer au niveau de la corbeille
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-center">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                            <form action="{{ route('paiement_personnel.destroy',$paiement->id) }}" method="post" id="deleteform">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('DELETE') }}
                                                                                <button  type="button" onclick = "formSubmit()" class="btn btn-danger" data-dismiss="modal">
                                                                                    Oui Supprimer
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="container">
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="myModal{{ $paiement->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button> --}}
                                                                                <h4 class="modal-title text-center" id="myModalLabel">Modification Du Paiement D'un Personnel</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                    <form action="{{ route('paiement_personnel.update',$paiement->id) }}" method="post">
                                                                                        {{ csrf_field() }}
                                                                                        {{ method_field('PUT') }}
                                                                                        <div class="form-group">
                                                                                            <label for="montant">Montant Payer *</label>
                                                                                            <input type="number"
                                                                                            class="form-control" name="montant" id="montant" value="{{ $paiement->somme_payer }}" aria-describedby="helpId" placeholder="Entrez le montant payer" required>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="type_paiement">Type De Paiement</label>
                                                                                            <select class="form-control" name="type_paiement" id="type_paiement" required>
                                                                                              <option value="Espèce" @if($paiement->type_paiement == "Espèce") selected @endif>Espèce</option>
                                                                                              <option value="Dépot" @if($paiement->type_paiement == "Dépot") selected @endif>Dépôt</option>
                                                                                              <option value="Chèque" @if($paiement->type_paiement == "Chèque") selected @endif>Chèque</option>
                                                                                              <option value="Autres" @if($paiement->type_paiement == "Autres") selected @endif>Autres</option>
                                                                                            </select>
                                                                                          </div>
                                                                                        <div class="form-group">
                                                                                            <label for="date_paiement">Date Paiement*</label>
                                                                                            <input type="date"
                                                                                            class="form-control" name="date_paiement" id="date_paiement" value="{{ $paiement->date_paiement->format('Y-m-d') }}"  aria-describedby="helpId" placeholder="" required />
                                                                                        </div>
                                                                                        <br>
                                                                                        <div class="container center">
                                                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
    @if($all_paiement->count() > 0)
        <div id="imprime" class="row">
            {{-- utiliser pour l'impression (rendu css) --}}
            <style>
                table {
                    table-layout: auto;
                    width: 100%;
                }

                table td {
                    word-wrap: break-word;         /* All browsers since IE 5.5+ */
                    overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
                }
                @media print{
                    table {
                    table-layout: auto;
                    width: 100%;
                }

                table td {
                    word-wrap: break-word;         /* All browsers since IE 5.5+ */
                    overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
                }
                    /* @page {size: landscape} */
                    .font-bold {
                        font-weight: bold;
                    }

                    .rouge{
                        color: rgb(255, 0, 0) !important;
                        font-style: italic !important;
                    }
                    .jaune{
                        color: yellow !important;
                        font-style: italic !important;
                    }
                    .vert{
                        color: rgb(6, 168, 6) !important;
                        font-style: italic !important;
                    }
                    #bordure_table{
                        border: 2px solid black !important;
                        font-size: 20px;
                    }
                    #bordure_tables{
                        width: 50px;
                        border: 2px solid black !important;
                        font-size: medium;
                        word-break: normal;
                    }
                    .cercle{
                                border: 5px solid;
                                border-radius: 20px;
                                padding: 0px;
                                margin-right: -33px;
                            }
                    .align-top{
                                text-align: center;
                                margin-top: -68px;
                            }
                    #harounaya{
                        font-weight: bolder;
                    }
                    #paragraphe
                    {
                        font-size: medium;
                    }
                    #cadre{
                    border-width:5px 5px;
                    border-style:double;
                    border-color:black;
                    padding:0 10px;
                    }
                    #separateur2{
                        border-width:5px;
                        border-style:dashed;
                        border-color:black;
                    }
                }
            </style>
            <div id="invisible-screens" class="col-md-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <address>
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">METFP</u>
                                            <br>
                                            <u class="souligner">I.R.E: Conakry</u>
                                        </h4>
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">I.S.S.D GANDAL PLUS</u>
                                        </h4>
                                    </address>
                                </div>
                                <div class="pull-right text-right">
                                    <address>
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">REPUBLIQUE DE GUINEE</u>&emsp;&ensp;
                                         <br>
                                           <u class="rouge">TRAVAIL</u>-<u class="jaune">JUSTICE</u>-<u class="vert">SOLIDARITE</u>
                                        </h4>
                                    </address>
                                </div>
                                <div class="center">
                                     <img src="/images/photos/logos/logo_gandal2.jpg" width="100px" heigth="100px" alt="logo_ecole" srcset="">
                                </div>
                            </div>
                            <div class="row col-md-12 col-sm-12 col-lg-12">
                                <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                    <div class="cercles">
                                        <div class="text-center">
                                            <h4 class="font-bold">
                                                <i class="souligner">Reçu De Paiement &nbsp; Date: {{ $all_paiement->last()->date_paiement->format('d/m/Y') }}
                                                </i>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cadres">
                                {{-- <p>Cher parent/tuteur,<br> Nous avons bien reçu votre paiement et nous vous en remercions</p> --}}
                                <table class="table table-bordered">
                                    <thead>
                                        <th id="bordure_table">Personnel</th>
                                        <th id="bordure_table">Contact</th>
                                        <th id="bordure_table">Mois</th>
                                        <th id="bordure_table">Salaire</th>
                                        <th id="bordure_table">Payer</th>
                                        <th id="bordure_table">Reste</th>
                                    </thead>
                                    <tbody>
                                        <tr id="bordure_table">
                                            <td id="bordure_table">{{ $personnel->prenom.' '.$personnel->nom }}</td>
                                            <td id="bordure_table">{{ $personnel->telephone }}</td>
                                            <td id="bordure_table">
                                                @if ($all_paiement->last()->mois_paiement == 1)
                                                    {{ "Janvier" }}
                                                @elseif($all_paiement->last()->mois_paiement == 2)
                                                    {{ "Février" }}
                                                @elseif($all_paiement->last()->mois_paiement == 3)
                                                    {{ "Mars" }}
                                                @elseif($all_paiement->last()->mois_paiement == 4)
                                                    {{ "Avril" }}
                                                @elseif($all_paiement->last()->mois_paiement == 5)
                                                    {{ "Mai" }}
                                                @elseif($all_paiement->last()->mois_paiement == 6)
                                                    {{ "Juin"}}
                                                @elseif($all_paiement->last()->mois_paiement == 7)
                                                    {{ "Juillet" }}
                                                @elseif($all_paiement->last()->mois_paiement == 8)
                                                    {{ "Août" }}
                                                @elseif($all_paiement->last()->mois_paiement == 9)
                                                    {{ "Septembre" }}
                                                @elseif($all_paiement->last()->mois_paiement == 10)
                                                    {{ "Octobre" }}
                                                @elseif($all_paiement->last()->mois_paiement == 11)
                                                    {{ "Novembre" }}
                                                @else
                                                    {{ "Décembre" }}
                                                @endif
                                            </td>
                                            <td id="bordure_table">{{ number_format($personnel->PaiementPersonnels->last()->salaire_du_mois,0,'.',' ') }}</td>
                                            <td id="bordure_table">{{ number_format($personnel->PaiementPersonnels->last()->somme_payer,0,'.',' ') }}</td>
                                            <td id="bordure_table">
                                                {{ number_format($personnel->PaiementPersonnels->last()->salaire_du_mois - $personnel->PaiementPersonnels->last()->somme_payer,0,'.',' ') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- <p>Recevez, cher parent/tuteur, nos sincères salutations</p> --}}
                            </div>
                            <div id="ecriture">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6 pull-left">
                                            <h4 class="font-bold text-left">Personnel</h4>
                                        </div>
                                        <div id="vendeur" class="col-md-6 pull-right">
                                            <h4 class="font-bold text-right">
                                                Comptable
                                            </h4>
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                        <br><br><br><br><br>
                            <div id="separateur2">
                            </div>
                        <br><br><br><br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <address>
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">METFP</u>
                                            <br>
                                            <u class="souligner">I.R.E: Conakry</u>
                                        </h4>
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">I.S.S.D GANDAL PLUS</u>
                                        </h4>
                                    </address>
                                </div>
                                <div class="pull-right text-right">
                                    <address>
                                        <h4 class="font-bold addr-font-h4">
                                            <u class="souligner">REPUBLIQUE DE GUINEE</u>&emsp;&ensp;
                                         <br>
                                           <u class="rouge">TRAVAIL</u>-<u class="jaune">JUSTICE</u>-<u class="vert">SOLIDARITE</u>
                                        </h4>
                                    </address>
                                </div>
                                <div class="center">
                                     <img src="/images/photos/logos/logo_gandal2.jpg" width="100px" heigth="100px" alt="logo_ecole" srcset="">
                                </div>
                            </div>
                            <div class="row col-md-12 col-sm-12 col-lg-12">
                                <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                                    <div class="cercles">
                                        <div class="text-center">
                                            <h4 class="font-bold">
                                                <i class="souligner">Reçu De Paiement  &nbsp; Date: {{ $all_paiement->last()->date_paiement->format('d/m/Y') }}
                                                </i>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cadres">
                                {{-- <p>Cher parent/tuteur,<br> Nous avons bien reçu votre paiement et nous vous en remercions</p> --}}
                                <table class="table table-bordered">
                                    <thead>
                                        <th id="bordure_table">Personnel</th>
                                        <th id="bordure_table">Contact</th>
                                        <th id="bordure_table">Mois</th>
                                        <th id="bordure_table">Salaire</th>
                                        <th id="bordure_table">Payer</th>
                                        <th id="bordure_table">Reste</th>
                                    </thead>
                                    <tbody>
                                        <tr id="bordure_table">
                                            <td id="bordure_table">{{ $personnel->prenom.' '.$personnel->nom }}</td>
                                            <td id="bordure_table">{{ $personnel->telephone }}</td>
                                            <td id="bordure_table">
                                                @if ($all_paiement->last()->mois_paiement == 1)
                                                    {{ "Janvier" }}
                                                @elseif($all_paiement->last()->mois_paiement == 2)
                                                    {{ "Février" }}
                                                @elseif($all_paiement->last()->mois_paiement == 3)
                                                    {{ "Mars" }}
                                                @elseif($all_paiement->last()->mois_paiement == 4)
                                                    {{ "Avril" }}
                                                @elseif($all_paiement->last()->mois_paiement == 5)
                                                    {{ "Mai" }}
                                                @elseif($all_paiement->last()->mois_paiement == 6)
                                                    {{ "Juin"}}
                                                @elseif($all_paiement->last()->mois_paiement == 7)
                                                    {{ "Juillet" }}
                                                @elseif($all_paiement->last()->mois_paiement == 8)
                                                    {{ "Août" }}
                                                @elseif($all_paiement->last()->mois_paiement == 9)
                                                    {{ "Septembre" }}
                                                @elseif($all_paiement->last()->mois_paiement == 10)
                                                    {{ "Octobre" }}
                                                @elseif($all_paiement->last()->mois_paiement == 11)
                                                    {{ "Novembre" }}
                                                @else
                                                    {{ "Décembre" }}
                                                @endif
                                            </td>
                                            <td id="bordure_table">{{ number_format($personnel->PaiementPersonnels->last()->salaire_du_mois,0,'.',' ') }}</td>
                                            <td id="bordure_table">{{ number_format($personnel->PaiementPersonnels->last()->somme_payer,0,'.',' ') }}</td>
                                            <td id="bordure_table">{{ number_format($personnel->PaiementPersonnels->last()->salaire_du_mois - $personnel->PaiementPersonnels->last()->somme_payer,0,'.',' ') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- <p>Recevez, cher parent/tuteur, nos sincères salutations</p> --}}
                            </div>
                            <div id="ecriture">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6 pull-left">
                                            <h4 class="font-bold text-left">Personnel</h4>
                                        </div>
                                        <div id="vendeur" class="col-md-6 pull-right">
                                            <h4 class="font-bold text-right">
                                                Comptable
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
{{-- script utiliser pour la suppression d'un paiement --}}
<script>
    function deleteData(id)
         {
             var id = id;
             var url = '{{ route("paiement_personnel.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteform").attr('action', url);
         }
    function formSubmit()
    {
        // alert("bonjour");
        $("#deleteform").submit();
    }
</script>
