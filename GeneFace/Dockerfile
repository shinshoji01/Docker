FROM nvidia/cuda:11.3.1-cudnn8-devel-ubuntu20.04

COPY . /build_context
WORKDIR /opt

ENV TZ Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
	    sudo \
	    wget \
        libasound2-dev \
        portaudio19-dev \
	    ffmpeg \
	    libsm6 \
	    libxext6 \
        && rm -rf /var/lib/apt/lists/*

# Install Miniconda
RUN wget https://repo.anaconda.com/miniconda/Miniconda3-latest-Linux-x86_64.sh \
    && mkdir /root/.conda \
        && bash Miniconda3-latest-Linux-x86_64.sh -b \
            && rm -f Miniconda3-latest-Linux-x86_64.sh
ENV PATH=/root/miniconda3/bin:$PATH

# Install Environment in Conda
RUN conda create -n geneface python=3.9.16 -y
RUN conda install -n geneface pytorch==1.11.0 torchvision==0.12.0 torchaudio==0.11.0 cudatoolkit=11.3 -c pytorch -y
RUN conda install -n geneface -c fvcore -c iopath -c conda-forge fvcore iopath -y
RUN conda install -n geneface -c bottler nvidiacub -y
RUN conda install -n geneface pytorch3d -c pytorch3d -y # 0.7.2 recommended
RUN conda install -n geneface ffmpeg -y
#RUN pip3 install --upgrade pip && \
#            pip3 install -r /build_context/requirements.txt 
RUN /bin/bash -c "source activate geneface && pip install -r /build_context/requirements.txt -i https://mirrors.aliyun.com/pypi/simple/"


WORKDIR /work2/Git/CUHKSZ/GeneFace
