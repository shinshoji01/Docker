#FROM nvidia/cuda:10.1-cudnn7-runtime-ubuntu18.04
#FROM nvidia/cuda:11.1.1-runtime-ubuntu20.04
FROM nvidia/cuda:10.2-runtime-ubuntu18.04
# FROM stereolabs/zed:3.4-runtime-cuda11.0-ubuntu18.04

COPY . /build_context
WORKDIR /opt

ENV TZ Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
	    libgl1-mesa-dev \
	    libsndfile-dev \
	    python3 \
	    python3-pip \
	    sudo \
	    wget \
	    vim \
        libglib2.0-0 \
        libsm6 \
        libxrender1 \
        libxext6 \
        libgomp1

# python packages
RUN pip3 install --upgrade pip && \
	    pip3 install -r /build_context/requirements.txt

WORKDIR /work

CMD ["bash"]
