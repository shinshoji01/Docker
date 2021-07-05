docker build -f python/docker/Dockerfile -t python-initialization:latest python/docker/
docker run --name python_init --gpus all -it -v $PWD/python/file/:/work -v $PWD/python/file/cache/:/work/cache/ -v $PWD/python/file/parameters/:/work/parameters/ python-initialization python3 /work/initialize.py
docker restart python_init
docker exec -it python_init cp -r /root/.cache/torch/hub/nvidia_DeepLearningExamples_torchhub/ /work/cache/
docker restart python_init
docker exec -it python_init cp -r /root/.cache/torch/hub/NVIDIA_DeepLearningExamples_torchhub/ /work/cache/
docker stop python_init
docker rm python_init

sudo mkdir db/mysql/
sudo cp -r bin/mysql_initial/* db/mysql/
