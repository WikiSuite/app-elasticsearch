
Name: app-elasticsearch
Epoch: 1
Version: 1.0.2
Release: 1%{dist}
Summary: Elasticsearch
License: GPLv3
Group: ClearOS/Apps
Packager: eGloo
Vendor: WikiSuite
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base

%description
Elasticsearch is a flexible and powerful free / libre / open source, distributed, real-time search and analytics engine. It is super fast, RESTful, based on Apache Lucene.

%package core
Summary: Elasticsearch - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: elasticsearch
Requires: java

%description core
Elasticsearch is a flexible and powerful free / libre / open source, distributed, real-time search and analytics engine. It is super fast, RESTful, based on Apache Lucene.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/elasticsearch
cp -r * %{buildroot}/usr/clearos/apps/elasticsearch/

install -d -m 0755 %{buildroot}/var/clearos/elasticsearch
install -d -m 0755 %{buildroot}/var/clearos/elasticsearch/backup
install -D -m 0644 packaging/elasticsearch.php %{buildroot}/var/clearos/base/daemon/elasticsearch.php

%post
logger -p local6.notice -t installer 'app-elasticsearch - installing'

%post core
logger -p local6.notice -t installer 'app-elasticsearch-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/elasticsearch/deploy/install ] && /usr/clearos/apps/elasticsearch/deploy/install
fi

[ -x /usr/clearos/apps/elasticsearch/deploy/upgrade ] && /usr/clearos/apps/elasticsearch/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-elasticsearch - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-elasticsearch-core - uninstalling'
    [ -x /usr/clearos/apps/elasticsearch/deploy/uninstall ] && /usr/clearos/apps/elasticsearch/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/elasticsearch/controllers
/usr/clearos/apps/elasticsearch/htdocs
/usr/clearos/apps/elasticsearch/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/elasticsearch/packaging
%exclude /usr/clearos/apps/elasticsearch/unify.json
%dir /usr/clearos/apps/elasticsearch
%dir /var/clearos/elasticsearch
%dir /var/clearos/elasticsearch/backup
/usr/clearos/apps/elasticsearch/deploy
/usr/clearos/apps/elasticsearch/language
/usr/clearos/apps/elasticsearch/libraries
/var/clearos/base/daemon/elasticsearch.php
