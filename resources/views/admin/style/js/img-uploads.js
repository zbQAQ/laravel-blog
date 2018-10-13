
/**
* imgTpBase64 图片转成base64
* 
* @param imgfiles 图片的临时存储路径
* @param callback 回调函数 由于处理base64有点慢 所以需要等所有图片组处理完成在执行下一步操作
* @return []  返回 一个数组里面对应键值的图片base64码 当只选择一个图片的时候数组里就一个元素
* 
*/
function imgTpBase64(imgfiles, callback) {
  let imgBase64_arr = []
  for(var i = 0; i < imgfiles.length; i++) { 
    var reader = new FileReader()
    reader.readAsDataURL(imgfiles[i])
    reader.onload = function(e) {  
      imgBase64_arr.push(e.target.result)
      if(imgBase64_arr.length === imgfiles.length){
          callback()
      }
    }
  }
  return imgBase64_arr;
}
