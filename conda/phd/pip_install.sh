pip install --upgrade pip -i https://mirrors.aliyun.com/pypi/simple/ && \
	pip install -r requirements.txt -i https://mirrors.aliyun.com/pypi/simple/ && \
	pip install torch==1.10.0+cu111 torchvision==0.11.1+cu111 torchaudio===0.10.0+cu111 -f https://download.pytorch.org/whl/torch_stable.html -i https://mirrors.aliyun.com/pypi/simple/
