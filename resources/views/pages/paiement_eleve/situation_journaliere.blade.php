@extends($chemin_theme_actif,['title' => 'Situation-Journalière'])
@section('content')
<div id="media_screen" class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Situation journalière</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                    href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Situation</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Situation journalière</li>
        </ol>
    </div>
</div>
<div id="media_screen" class="row">
    <div class="col-md-12">
        <div class="card card-topline-red">
            <div class="card-head">
                <header>Situation journalière du {{ $date->format('d/m/Y') }}</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh"
                        href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down"
                        href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times"
                        href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="btn-group">
                            <a href="{{ route('paiement_eleve.index') }}" id="addRow"
                                class="btn btn-info">
                                <i class="fa fa-reply"></i> Retour
                            </a>
                        </div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#par_jour">Afficher par jour
                            <i class="fa fa-list"></i>
                        </button>
                        <!-- debut modal -->
                            <div class="modal fade" data-backdrop="static" id="par_jour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div  class="modal-header btn btn-danger text-center text-white">
                                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Choisir une date</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="white-text">&times;</span>
                                            </button>
                                        </div>
                                        <!-- start modal body -->
                                            <div class="modal-body">
                                                    <form action="{{ route('show_situation_journaliere') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="date_ajout">Date *</label>
                                                            <input type="date"
                                                                class="form-control" name="date_choisie" id="date_choisie" value="{{ old('date_choisie') }}"  required>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-primary">Valider<i class="fa fa-check"> </i></button>
                                                            <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                        </div>
                                                    </form>
                                            </div>
                                        <!-- end modal body -->
                                    </div>
                                </div>
                            </div>
                        <!-- fin modal -->
                    </div>
                </div>
                <div class="table-scrollable">
                    <table
                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                            id="eleves">
                        <thead>
                            <tr>
                                <th class="text-center"> N° </th>
                                <th class="text-center"> Etudiant </th>
                                <th class="text-center"> Classe </th>
                                <th class="text-center"> Montant Payer </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($all_paiements as $paiement)
                                <tr class="odd gradeX">
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $paiement->eleve->prenom.' '.$paiement->eleve->nom }}</td>
                                    <td class="text-center">{{ $paiement->eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->nom_niveau.' '.$paiement->eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->option }}</td>
                                    <td class="text-center">
                                         {{ number_format($paiement->somme_payer,0,',',' ').' GNF' }}
                                    </td>
                                </tr>
                                @php
                                    $total = $total + $paiement->somme_payer;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <h3><u>Montant total:</u> {{ number_format($total,0,',',' ').' GNF' }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div id="imprime" class="row">
    {{-- utiliser pour l'impression (rendu css) --}}
    <style>
        @media print{
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
                                    <u class="souligner">I.R.E: Labé</u>
                                </h4>
                                <h4 class="font-bold addr-font-h4">
                                    <u class="souligner">INSTITUT DE FORMATION PROFESSIONNEL <br> ET TECHNIQUE DE DARA ETOILE LABE (DEL)</u>
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
                                <img src="/images/photos/logos/del.jpeg" width="250px" heigth="250px" alt="logo_ecole" srcset="">
                        </div>
                    </div>
                    <br>
                    <div class="row col-md-12 col-sm-12 col-lg-12">
                        <div class="mx-auto col-md-12 col-sm-12 col-lg-12">
                            <div class="cercle">
                                <div class="text-center">
                                    <h4 class="font-bold addr-font-h4">
                                        <u class="souligner">Situation Journaliere du {{ $date->format('d/m/Y') }}</u>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div>
                        <table id="bordure_table" class="table table-bordered">
                            {{-- <th class="text-center" id="bordure_table">@lang('liste_eleve.Image')</th> --}}
                            <th class="text-center" id="bordure_table">N°</th>
                            <th class="text-center" id="bordure_table">Elève</th>
                            <th class="text-center" id="bordure_table">Classe</th>
                            <th class="text-center" id="bordure_table">Montant payer</th>
                            <tbody id="bordure_table">
                                @php
                                    $p = 1;
                                @endphp
                                @foreach ($all_paiements as $paiement)
                                <tr class="odd gradeX">
                                    <td class="text-center" id="bordure_table">{{ $p++ }}</td>
                                    <td class="text-center" id="bordure_table">{{ $paiement->eleve->prenom.' '.$paiement->eleve->nom }}</td>
                                    <td class="text-center" id="bordure_table">{{ $paiement->eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->nom_niveau.' '.$paiement->eleve->inscrits->where('annee_id',$annee_courante->id)->first()->niveau->option }}</td>
                                    <td class="text-center">
                                         {{ number_format($paiement->somme_payer,0,',',' ').' GNF' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h3><u>Montant total: </u> {{ $total.' GNF' }}</h3>
                    </div>
                    <div>
                        <div class="pull-left">
                            <h4 class="font-blod addr-font-h4">Fondateur <br> Mr Bangoura Aboubacar</h4>
                        </div>
                        <div class="pull-right">
                            <h4>Comptable <br>Mr Keita Sekouba</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
