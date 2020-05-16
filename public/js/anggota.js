
$('body').on("click", ".hapusmember-btn", function () {
    $('#id_member').html(this.id);
    $('#id_member').attr('href', '/profil/'+this.id);
    $('#input_id_member').val(this.id);
});

$('body').on("click", ".jadiadmin-btn", function () {
    $('#id_member_admin').html(this.id);
    $('#id_member_admin').attr('href', '/profil/'+this.id);
    $('#input_id_member_admin').val(this.id);
});