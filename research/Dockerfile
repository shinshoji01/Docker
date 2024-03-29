#FROM nvidia/cuda:10.1-cudnn7-runtime-ubuntu18.04
FROM nvidia/cuda:11.1.1-runtime-ubuntu20.04
#FROM nvidia/cuda:10.2-runtime-ubuntu18.04

COPY . /build_context
WORKDIR /opt

ENV TZ Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
	    libsndfile-dev \
	    python3 \
	    python3-pip \
	    sudo \
	    wget \
	    vim

# nodejs
RUN sudo apt-get install -y nodejs npm && \
	    sudo npm install n -g && \
	    sudo n stable && \
	    sudo apt purge -y nodejs npm

# python packages
RUN pip3 install --upgrade pip && \
	    pip3 install -r /build_context/requirements.txt

RUN pip install torch==1.8.1+cu111 torchvision==0.9.1+cu111 torchaudio==0.8.1 -f https://download.pytorch.org/whl/torch_stable.html

ENV HOME /opt
# activate TAB completion
RUN ipython profile create default && \
	    echo "c.Completer.use_jedi = False" >> /opt/.ipython/profile_default/ipython_config.py

# jupyterlab extension
RUN jupyter labextension install jupyterlab_vim && \
	    # plotly
	    pip install plotly==4.14.3 && \
	    jupyter labextension install @jupyterlab/plotly-extension && \
	    # ipywidget
	    pip install ipywidgets && \
	    jupyter nbextension enable --py --sys-prefix widgetsnbextension && \
	    jupyter labextension install @jupyter-widgets/jupyterlab-manager@1.1

RUN mkdir -p /opt/.jupyter/lab/user-settings/@jupyterlab/apputils-extension && \
	    echo '{"theme":"JupyterLab Dark"}' > /opt/.jupyter/lab/user-settings/@jupyterlab/apputils-extension/themes.jupyterlab-settings && \
	    mkdir -p /opt/.jupyter/lab/user-settings/@jupyterlab/notebook-extension && \
	    echo '{"codeCellConfig":{"lineNumbers":true }}' >   /opt/.jupyter/lab/user-settings/@jupyterlab/notebook-extension/tracker.jupyterlab-settings

WORKDIR /work

#ENTRYPOINT ["nohup", "jupyter", "lab", "--ip=0.0.0.0", "--no-browser", "--allow-root", "--NotebookApp.token=''", "--port"]

CMD ["bash"]
#CMD ["jupyter", "lab", "--ip=0.0.0.0", "--no-browser", "--allow-root"]
#CMD ["nohup", "jupyter", "lab", "--ip=0.0.0.0", "--no-browser", "--allow-root", "--port", "8085", "--NotebookApp.token=''", ">", "nohup.out", "&"]
#CMD ["jupyter", "lab", "--ip=0.0.0.0", "--no-browser", "--allow-root", "--port", "8085", "--NotebookApp.token=''"]
#CMD ["8080"]
