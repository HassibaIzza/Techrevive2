@php
    use Illuminate\Support\Facades\Auth;
    $role = Auth::user()->role;
    $status = Auth::user()->status;
@endphp


<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend_assets')}}/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <a href="./index.html" class="navbar-brand" id="logo" style="font-family: 'Merriweather', serif"><span id="span1">T</span>Ech<span>Revive</span>
            </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="menu-label">Utilisateur</li>
        <li>
            <a href="{{route( $role . '-profile')}}" aria-expanded="false">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Profil</div>
            </a>
        </li>
        <li>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <a href="{{route('logout')}}" aria-expanded="false" onclick="event.preventDefault(); this.closest
                ('form').submit();">
                    <div class="parent-icon"><i class="bx bx-log-out-circle"></i>
                    </div>
                    <div class="menu-title">Déconnecter</div>
                </a>
            </form>

        </li>
        <li class="menu-label"></li>
        @if($role === 'admin')
            <li>
                <a  href="{{route('admin-vendor-list')}}" style="cursor: pointer">
                    <div class="parent-icon"><i class='lni lni-world'></i>
                    </div>
                    <div class="menu-title">Utilisateurs</div>
                </a>

            </li>
        @endif

        @if($status && $role != 'Fabricant' && $role != 'client' && $role != 'reparateur')
            <li>
                <a class="has-arrow" style="cursor: pointer">
                    <div class="parent-icon"><i class='lni lni-checkmark-circle'></i>
                    </div>
                    <div class="menu-title">Marques</div>
                </a>
                <ul>
                    @if($role === 'admin')
                    <li> <a href="{{route('brand')}}"><i class="bx bx-right-arrow-alt"></i>Afficher tous</a>
                    </li>
                    @endif
                    <li> <a href="{{route('brand-add')}}"><i class="bx bx-right-arrow-alt"></i>Ajouter Marque</a>
                    </li>
                </ul>

            </li>
            <li>
                <a >
                    <div class="parent-icon"><i class='lni lni-folder'></i>
                    </div>
                    <div class="menu-title">Catégories</div>
                </a>
                <ul>
                    @if($role === 'admin')
                    <li> <a href="{{route('category')}}"><i class="bx bx-right-arrow-alt"></i>Afficher tous</a>
                    </li>
                    @endif
                    <li> <a href="{{route('category-add')}}"><i class="bx bx-right-arrow-alt"></i>Ajouter Catégorie</a>
                    </li>
                </ul>
            </li>
            <li>
                <a >
                    <div class="parent-icon"><i class='lni lni-checkmark-circle'></i>
                    </div>
                    <div class="menu-title">Sous Catégories</div>
                </a>
                <ul>
                    @if($role === 'admin')
                    <li> <a href="{{route('sub-category')}}"><i class="bx bx-right-arrow-alt"></i>Afficher tous</a>
                    </li>
                    @endif
                    <li> <a href="{{route('sub-category-add')}}"><i class="bx bx-right-arrow-alt"></i>Ajouter sous
                            Catégorie</a>
                    </li>
                </ul>
            </li>
            <li>
                <a >
                    <div class="parent-icon"><i class='lni lni-graph'></i>
                    </div>
                    <div class="menu-title">Annonces</div>
                </a>
                <ul>
                    <li> <a href="{{route($role . '-product')}}"><i class="bx bx-right-arrow-alt"></i>Afficher tous</a>
                    </li>

                    <li> <a href="{{route($role . '-product-add')}}"><i class="bx bx-right-arrow-alt"></i>Ajouter
                            annonce</a>
                    </li>
                </ul>
            </li>
            <li>
                <a >
                    <div class="parent-icon"><i class='lni lni-wallet'></i>
                    </div>
                    <div class="menu-title">Coupons</div>
                </a>
                <ul>
                    <li> <a href="{{route('vendor-coupon')}}"><i class="bx bx-right-arrow-alt"></i>Afficher tous</a>
                    </li>
                    <li> <a href="{{route('vendor-coupon-add')}}"><i class="bx bx-right-arrow-alt"></i>Ajouter Coupon</a>
                    </li>
                </ul>
            </li>
        @endif
        @if($role === 'client')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('demandes.recentes') }}">
                <i class="fas fa-list-alt"></i> Demandes récentes
            </a>
        </li>
        @endif

        @if($status && $role === 'Fabricant')
        <li>
            <a >
                <div class="parent-icon"><i class='lni lni-checkmark-circle'></i>
                </div>
                <div class="menu-title">Marque</div>
            </a>
            <ul>
                <li> <a href="{{route('marques.show')}}"><i class="bx bx-right-arrow-alt"></i>Afficher tous</a>
                </li>
                <li> <a href="{{route('marque-add')}}"><i class="bx bx-right-arrow-alt"></i>Ajouter Marque</a>
                </li>
            </ul>

        </li>
        @endif

        <li>
        <ul>
            @if($status && $role === 'Fabricant')
            <li>
                <a >
                    <div class="parent-icon"><i class='lni lni-checkmark-circle'></i>
                    </div>
                    <div class="menu-title">Liste des pannes</div>
                </a>
                <ul>
                    <li> <a href="{{ route('listepannes') }}"><i class="bx bx-right-arrow-alt"></i>Afficher tous</a>
                    </li>
                    <li> <a href="{{route('pannes-add')}}"><i class="bx bx-right-arrow-alt"></i>Ajouter panne fréquente</a>
                    </li>
                </ul>

            </li>

            @endif
        </ul>
        </li>
        <li>
            <ul>
                @if($status)
                <li>
                    <a >
                        <div class="parent-icon"><i class='lni lni-checkmark-circle'></i>
                        </div>
                        <div class="menu-title">Mes Favoris</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('show.favorite') }}"><i class="bx bx-right-arrow-alt"></i>Afficher tous</a>
                        </li>

                    </ul>

                </li>

                @endif
            </ul>
        </li>
    </ul>

    <!--end navigation-->
</div>

<script>
    const submenuItems = document.querySelectorAll('.has-submenu');
    submenuItems.forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('submenu-open');
            const submenu = item.querySelector('.submenu');
            const submenuArrow = item.querySelector('.submenu-arrow i');
            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
                submenuArrow.classList.remove('bx-chevron-down');
                submenuArrow.classList.add('bx-chevron-right');
            } else {
                submenu.style.display = 'block';
                submenuArrow.classList.remove('bx-chevron-right');
                submenuArrow.classList.add('bx-chevron-down');
            }
        });
    });
</script>
<script>
  const submenuItems = document.querySelectorAll('.has-submenu');
  submenuItems.forEach(item => {
      const submenu = item.querySelector('.submenu');
      const submenuArrow = item.querySelector('.submenu-arrow i');

      item.addEventListener('click', () => {
          submenu.classList.toggle('submenu-open');
          submenuArrow.classList.toggle('bx-chevron-down');
          submenuArrow.classList.toggle('bx-chevron-right');
      });

      // Masquer les sous-menus par défaut
      submenu.style.display = 'none';
  });
</script>

