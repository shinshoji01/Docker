<?php
 
#$cmd = 'docker run --rm --gpus all -it network-lesson_python nvidia-smi';
#$cmd = "sudo /usr/bin/docker ps -a";
#$cmd = "docker --version";
#
#$cmd = "sudo gpasswd -a $(whoami) docker 2>&1";
#exec($cmd, $opt, $status);
#print_r($opt);
##
#if ($status !== 0) {
#    echo "Error_Code:". $status;
#} 

#$cmd = "docker ps -a 2>&1";
#$cmd = "sudo docker ps -a";
#$cmd = "sudo docker exec -it network-lesson_python_1 nvidia-smi";
$cmd = "sudo docker images";
exec($cmd, $opt, $status);
print_r($opt);
#
if ($status !== 0) {
    echo "Error_Code:". $status;
} 

#$output = shell_exec('RET=`docker run hello-world`;echo $RET');
#echo $output;

#echo '<pre>';
#$content = system('docker images', $ret);
#echo '</pre>';
 
?>
