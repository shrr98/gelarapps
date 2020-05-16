{% extends "layouts/base.volt" %}

{% block title %}{{profil.nama}}{% endblock %}

{% block content %}
    {{ this.flash.output() }}
    <h1>{{profil.nama}}</h1>
    {% if profil.photo %}
        {{ image('data:image/png;base64,'~profil.photo, "width" : "30%", 'alt' : 'profil picture')}}
    {% else %}
        {{ image('assets/default_pp.png', "width" : "30%", 'alt' : 'profil picture')}}
    {% endif %}

    <p>
        {{ '@'~profil.username }}
    </p>
    <p>
        {{ profil.email }}
    </p>
    <p>
        {{ profil.status }}
    </p>

    <button data-toggle='modal' data-target='#profilModal'>Sunting Profil</button>
    <button data-toggle='modal' data-target='#fotoModal'>Ubah Foto</button>
    <button data-toggle='modal' data-target='#akunModal'>Sunting Akun</button>

    <div class="modal" id="profilModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sunting Profil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ profilForm.startForm() }}
                    {{ profilForm.render('nama') }}
                    {{ profilForm.render('status') }}
                    {{ profilForm.render('Simpan') }}
                    {{ profilForm.endForm() }}
                </div>
                <!-- <div class="modal-footer">
                </div> -->
            </div>
        </div>
    </div>

    <div class="modal" id="fotoModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Foto Profil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="/profil/changephoto" method="post" enctype="multipart/form-data">
                    <input type="file" name="photo" id="photo">
                    <input type="submit" value="Simpan">
                    </form>
                </div>
                <!-- <div class="modal-footer">
                </div> -->
            </div>
        </div>
    </div>
    
    <div class="modal" id="akunModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sunting Akun</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ akunForm.startForm() }}
                    {{ akunForm.render('old_password') }}
                    {{ akunForm.render('password') }}
                    {{ akunForm.render('confirm_password') }}
                    {{ akunForm.render('Simpan') }}
                    {{ akunForm.endForm() }}
                </div>
                <!-- <div class="modal-footer">
                </div> -->
            </div>
        </div>
    </div>
{% endblock %}