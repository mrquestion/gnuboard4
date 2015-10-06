#----------------------------------------------------------------------
# File Upload Module Library
#
#	AttachFile
#
#	Author	: Chang Ho Na
#	Email	: chna@chcode.com
#
#======================================================================

package AttachFile;
#----------------------------------------------------------------------

use strict;
use IO::Handle;
use IO::File;
use vars qw /@ISA @EXPORT @EXPORT_OK/;
require Exporter;
require AutoLoader;

@ISA = qw/Exporter AutoLoader/;
@EXPORT = qw//;
@EXPORT_OK = qw//;

sub new {
#----------------------------------------------------------------------
#
#
	my $this = shift;
	my $self = { '_ufile' => shift };
	my $fh = new IO::Handle->fdopen(fileno($self->{'_ufile'}), "r")
		|| return undef;
	
	$self->{'_fh'} = $fh;
	$self->{'_deny_ext'} = [];
	$self->{'_allow_char'} = ['\w', '\-', '\.'];
	
	bless ($self, $this);
}

sub _allow_char() 	{ $_[0]->{'_allow_char'} }
sub _deny_ext() 	{ $_[0]->{'_deny_ext'} }

sub allow_char(;@) {
#----------------------------------------------------------------------
#
#
	return @{$_[0]->_allow_char} unless @_ > 1;
	my ($self) = shift;
	
	push(@{$self->_allow_char}, @_);
	$self->allow_char;
}

sub deny_ext(;@) {
#----------------------------------------------------------------------
#
#
	return @{$_[0]->_deny_ext} unless @_ > 1;
	my ($self) = shift;
	map { my $ext = $_; $ext =~ s/^\.//g; push(@{$self->_deny_ext}, $ext) } @_;

	$self->deny_ext;
}

sub _file_ext() { $_[0]->{'_file_ext'} }

sub fh() 	{ $_[0]->{'_fh'} }
sub get_line() 	{ $_[0]->fh->getline }
sub get_lines() { $_[0]->fh->getlines }
sub get_pos() 	{ tell($_[0]->fh) }

sub is_filename_allowed($) {
	my ($chars) = join("", @{$_[0]->_allow_char});
	return ($_[1] =~ /^[$chars]+$/) ? 1 : 0;
}

sub is_ext_denied($) {
	my ($exts) = join("|", @{$_[0]->_deny_ext});
	return 1 if $_[1] =~ /\.($exts)$/i;
	return 0;
}

sub orig_filename() {
	my $path = $_[0]->orig_filepath;
	$path =~ s/^.*[\\\/]([^\\\/]+)$/$1/g;

	return scalar($path);
}

sub orig_filepath() 	{ scalar($_[0]->ufile) }
sub save() 		{ $_[0]->save_as($_[0]->orig_filename) }

sub save_as($) {
#----------------------------------------------------------------------
#
#
	my $self = shift;
	my $newfilename = shift;
	my ($currpos, $newfh, $buffer, $total, $n, $n2);

	$total = $n = $n2 = 0;
	$buffer = undef;
	$newfh = undef;
	$currpos = $self->get_pos;
	$self->set_pos(0);

	($! = 2, return 0) unless $newfilename;
	($! = 22, return 0) if ($self->is_ext_denied($newfilename));
	#($! = 22, return 0) unless $self->is_filename_allowed($newfilename);

	$newfh = new IO::File $newfilename, "w";
	return 0 unless $newfh;

	if ($^O =~ /Win32/) {
		binmode($newfh);
		binmode($self->fh);
	}
	while (($n = read($self->fh, $buffer, 1024))) {
		$n2 = syswrite($newfh, $buffer, $n);
		$total += $n2;
	}

	$newfh->close;
	$self->set_pos($currpos);

	return $total;
}

sub set_pos($) 	{ seek($_[0]->fh, $_[1], 0) }
sub size() 	{ scalar((stat($_[0]->fh))[7]) }
sub ufile() 	{ $_[0]->{'_ufile'}; }

#----------------------------------------------------------------------
1;
