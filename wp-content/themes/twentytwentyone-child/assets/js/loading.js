$(function () {
  var webStorage = function () {
    if (sessionStorage.getItem('access')) {
      /*
        2��ڈȍ~�A�N�Z�X���̏���
      */
      $(".loading").addClass('is-active');
    } else {
      /*
        ����A�N�Z�X���̏���
      */
      sessionStorage.setItem('access', 'true'); // sessionStorage�Ƀf�[�^��ۑ�
      $(".loading-animation").addClass('is-active'); // loading�A�j���[�V������\��
      setTimeout(function () {
        // ���[�f�B���O�𐔕b��ɔ�\���ɂ���
        $(".loading").addClass('is-active');
        $(".loading-animation").removeClass('is-active');
      }, 2000); // ���[�f�B���O��\�����鎞��
    }
  }
  webStorage();
});