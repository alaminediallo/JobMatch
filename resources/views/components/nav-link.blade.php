@props(['active' => false, 'icon'])

<a class="nav-main-link{{ $active ? ' active' : '' }}" {{ $attributes }}>
    <i class="nav-main-link-icon fa fa-{{ $icon }}"></i>
    <span class="nav-main-link-name">{{ $slot }}</span>
</a>
