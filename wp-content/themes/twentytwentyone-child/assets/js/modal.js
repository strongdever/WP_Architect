$(function(){
   
  // �u.modal_open�v���N���b�N�����烂�[�_���ƍ����w�i��\������
  $('.modal_open').click(function(){
 
    // �����w�i��body���ɒǉ�
    $('body').append('<div class="modal_bg"></div>');
    $('.modal_bg').fadeIn();
 
    // data-target�̓��e��ID�ɂ���modal�ɑ��
    var modal = '#' + $(this).attr('data-target');
 
    // ���[�_�����E�B���h�E�̒����ɔz�u����
    function modalResize(){
        var w = $(window).width();
        var h = $(window).height();
 
        var x = (w - $(modal).outerWidth(true)) / 2;
        var y = (h - $(modal).outerHeight(true)) / 2;
 
        $(modal).css({'left': x + 'px','top': y + 'px'});
    }
 
    // modalResize�����s
    modalResize();
 
    // modal���t�F�[�h�C���ŕ\��
    $(modal).fadeIn();
 
    // .modal_bg��.modal_close���N���b�N�����烂�[�_���Ɣw�i���t�F�[�h�A�E�g������
    $('.modal_bg, .modal_close').off().click(function(){
        $('.modal_box').fadeOut();
        $('.modal_bg').fadeOut('slow',function(){
            $('.modal_bg').remove();
        });
    });
 
    // �E�B���h�E�����T�C�Y���ꂽ�烂�[�_���̈ʒu���Čv�Z����
    $(window).on('resize', function(){
        modalResize();
    });
 
    // .modal_switch�������ƃ��[�_����؂�ւ���
    $('.modal_switch').click(function(){
 
      // �����ꂽ.modal_switch�̐e�v�f��.modal_box���t�F�[�h�A�E�g������
      $(this).parents('.modal_box').fadeOut();
 
      // �����ꂽ.modal_switch��data-target�̓��e��ID�ɂ���modal�ɑ��
      var modal = '#' + $(this).attr('data-target');
 
      // ���[�_�����E�B���h�E�̒����ɔz�u����
      function modalResize(){
          var w = $(window).width();
          var h = $(window).height();
 
          var x = (w - $(modal).outerWidth(true)) / 2;
          var y = (h - $(modal).outerHeight(true)) / 2;
 
          $(modal).css({'left': x + 'px','top': y + 'px'});
      }
 
      // modalResize�����s
      modalResize();
 
      $(modal).fadeIn();
 
      // �E�B���h�E�����T�C�Y���ꂽ�烂�[�_���̈ʒu���Čv�Z����
      $(window).on('resize', function(){
          modalResize();
      });
    });
  });
});