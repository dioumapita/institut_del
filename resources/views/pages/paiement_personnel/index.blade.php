{{-- on herite du chemin du theme actif --}}
@extends($chemin_theme_actif,['title' => 'Paiement-Personnel'])
@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Paiement Du Personnel</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="{{ route('home') }}">Accueil</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Paiement</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Paiement Du Personnel</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>
                        Paiement Du Personnel Pour Le Mois
                        @if ($num_mois == 1)
                            {{ "De Janvier" }}
                        @elseif($num_mois == 2)
                            {{ "De Février" }}
                        @elseif($num_mois == 3)
                            {{ "De Mars" }}
                        @elseif($num_mois == 4)
                            {{ "D'Avril" }}
                        @elseif($num_mois == 5)
                            {{ "De Mai" }}
                        @elseif($num_mois == 6)
                            {{ "De Juin"}}
                        @elseif($num_mois == 7)
                            {{ "De Juillet" }}
                        @elseif($num_mois == 8)
                            {{ "D' Août" }}
                        @elseif($num_mois == 9)
                            {{ "De Septembre" }}
                        @elseif($num_mois == 10)
                            {{ "D' Octobre" }}
                        @elseif($num_mois == 11)
                            {{ "De Novembre" }}
                        @else
                            {{ "De Décembre" }}
                        @endif
                    </header>
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
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="btn-group">
                                <a href="{{ route('home') }}" id="addRow"
                                    class="btn btn-info">
                                    <i class="fa fa-reply"></i>Retour
                                </a>
                            </div>
                        </div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#afficher_par_mois">Choisir un autre mois
                            <i class="fa fa-plus"></i>
                        </button>
                        <div class="modal fade" data-backdrop="static" id="afficher_par_mois" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div  class="modal-header btn btn-danger text-center text-white">
                                        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Afficher les paiements par mois</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                    </div>
                                    <!-- start modal body -->
                                        <div class="modal-body">
                                                <div class="form-group">
                                                  <label for="">Selectionnez le mois</label>
                                                  <select onchange="window.location.href = this.value" class="form-control" name="num_mois" id="num_mois">
                                                    <option value="">Choisir ....</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',1) }}">Janvier</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',2) }}">Fevrier</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',3) }}">Mars</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',4) }}">Avril</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',5) }}">Mai</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',6) }}">Juin</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',7) }}">Juillet</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',8) }}">Août</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',9) }}">Septembre</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',10) }}">Octobre</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',11) }}">Novembre</option>
                                                    <option value="{{ route('paiement_des_personnels_par_mois',12) }}">Décembre</option>
                                                  </select>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button class="btn btn-danger" data-dismiss="modal">Annuler <i class="fa fa-times"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    <!-- end modal body -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table
                            class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                id="eleves">
                            <thead>
                                <tr>
                                    <th> Personnel </th>
                                    <th> Télephone </th>
                                    <th> Salaire </th>
                                    <th> Payer</th>
                                    <th> Reste</th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_personnels as $personnel)
                                    <tr class="odd gradeX">
                                        <td style="width: 18%">{{ $personnel->nom.' '.$personnel->prenom }}</td>
                                        <td>
                                            {{ $personnel->telephone }}
                                        </td>
                                        <td>
                                            @if($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois') > 0)
                                                {{ number_format(
                                                    (
                                                        $personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois')
                                                    )
                                                    ,0,'.',' ').' GNF'
                                                }}
                                            @else
                                                {{ number_format(
                                                    (
                                                        $personnel->salaire
                                                            -
                                                        (
                                                            $personnel->creditPersonnels->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit')
                                                            +
                                                            $personnel->creditPersonnels->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois')
                                                        )
                                                    )
                                                    ,0,'.',' ').' GNF'
                                                }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ number_format($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('somme_payer'),0,'.',' ') }}
                                        </td>
                                        <td>
                                            @if($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois') > 0)
                                                {{
                                                    number_format(
                                                        ($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois')
                                                        ) - ($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('somme_payer'))
                                                        ,0,'.',' ').' GNF'
                                                }}
                                            @else
                                                {{
                                                    number_format(
                                                        ($personnel->salaire
                                                            -
                                                        (
                                                            $personnel->creditPersonnels->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit')
                                                            +
                                                            $personnel->creditPersonnels->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois')
                                                        )) - ($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('somme_payer'))
                                                        ,0,'.',' ').' GNF'
                                                }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois') == 0)
                                                <a class="btn btn-danger" href="#aboutModal" data-toggle="modal" data-target="#myModal{{ $personnel->id }}">
                                                    <i class="fa fa-money"></i> Effectuer Un Paiement
                                                </a>
                                            @endif
                                            <a class="btn btn-primary" href="{{ route('paiement_personnel.show',$personnel->id) }}"><i class="fa fa-recycle"></i> Historique Des Paiements</a>
                                            <div class="container">
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal{{ $personnel->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header btn btn-danger col-md-12 col-lg-12 col-sm-12 col-12">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title text-center" id="myModalLabel">Paiement D'un Enseignant</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="center">
                                                                    <img src="/images/photos/enseignants/{{ $personnel->avatar }}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                                                                    <h4 class="media-heading">{{ $personnel->nom.' '.$personnel->prenom }}
                                                                        <br> Salaire:
                                                                            @if($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois') > 0)
                                                                                {{ number_format(
                                                                                    (
                                                                                        $personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois')
                                                                                    )
                                                                                    ,0,'.',' ').' GNF'
                                                                                }}
                                                                            @else
                                                                                {{ number_format(
                                                                                    (
                                                                                        $personnel->salaire
                                                                                            -
                                                                                        (
                                                                                            $personnel->creditPersonnels->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit')
                                                                                            +
                                                                                            $personnel->creditPersonnels->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois')
                                                                                        )
                                                                                    )
                                                                                    ,0,'.',' ').' GNF'
                                                                                }}
                                                                            @endif
                                                                        <br>
                                                                        Montant Payer:
                                                                        {{ number_format($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('somme_payer'),0,'.',' ').' GNF' }}
                                                                        <br>
                                                                        Reste:
                                                                            @if($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois') > 0)
                                                                                {{
                                                                                    number_format(
                                                                                        ($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois')
                                                                                            -
                                                                                        (
                                                                                            $personnel->creditPersonnels->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit')
                                                                                            +
                                                                                            $personnel->creditPersonnels->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois')
                                                                                        )) - ($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('somme_payer'))
                                                                                        ,0,'.',' ').' GNF'
                                                                                }}
                                                                            @else
                                                                                {{ number_format(
                                                                                    (
                                                                                        $personnel->salaire
                                                                                            -
                                                                                        (
                                                                                            $personnel->creditPersonnels->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit')
                                                                                            +
                                                                                            $personnel->creditPersonnels->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois')
                                                                                        )
                                                                                    )
                                                                                    ,0,'.',' ').' GNF'
                                                                                }}
                                                                            @endif
                                                                    </h4>
                                                                </div>
                                                                    {{-- si l'enseignant a un credit on ne peut pas effectuez de paiement pour cet enseignant avant qu'il rembourse --}}
                                                                    <form action="{{ route('paiement_personnel.store') }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="personnel_id" value="{{ $personnel->id }}">
                                                                        <input type="hidden" name="mois_paiement" value="{{ $num_mois }}">
                                                                        <input type="hidden" name="salaire_du_mois" value="{{ $personnel->salaire - ($personnel->creditPersonnels->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit') + $personnel->creditPersonnels->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois')) }}">
                                                                        @if($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois') > 0)
                                                                            <div class="form-group">
                                                                                <label for="montant">Montant Payer *</label>
                                                                                <input type="number"
                                                                                class="form-control" name="montant" id="montant" aria-describedby="helpId" placeholder="" required min="0" max="{{ $personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('salaire_du_mois') - ($personnel->creditPersonnels->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit') + $personnel->creditPersonnels->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois')) - ($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('somme_payer')) }}">
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group">
                                                                                <label for="montant">Montant Payer *</label>
                                                                                <input type="number"
                                                                                class="form-control" name="montant" id="montant" aria-describedby="helpId" placeholder="" required min="0" max="{{ $personnel->salaire - ($personnel->creditPersonnels->where('type_de_credit','Bon')->where('mois_remboursement',$num_mois)->sum('somme_credit') + $personnel->creditPersonnels->where('type_de_credit','Prêt')->where('debut_remboursement','<=',$num_mois)->where($num_mois,'<=','fin_remboursement')->sum('montant_par_mois')) - ($personnel->paiementPersonnels->where('mois_paiement',$num_mois)->sum('somme_payer')) }}">
                                                                            </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <label for="type_paiement">Type De Paiement</label>
                                                                            <select class="form-control" name="type_paiement" id="type_paiement" required>
                                                                            <option value="Espèce">Espèce</option>
                                                                            <option value="Dépot">Dépôt</option>
                                                                            <option value="Chèque">Chèque</option>
                                                                            <option value="Autres">Autres</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="date_paiement">Date Paiement *</label>
                                                                            <input type="date"
                                                                                class="form-control" name="date_paiement" id="date_paiement" aria-describedby="helpId" placeholder="Entrez la date de paiement" required>
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
@endsection
